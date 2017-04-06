<?php

namespace App\Controllers\Admin;

use App\Repositories\Categories;
use App\Repositories\Newss;

class HomeController extends Controller
{
    private $newss;
    private $uploadDir = UPLOAD_DIR . 'pdf/';
    private $pdfPath = '/public/uploads/pdf/';

    /**
     * HomeController constructor.
     */
    public function __construct()
    {
        parent::__construct();
        if (!$this->request->isAjax()) {
            $this->checkUserLoggedIn();
        }
        $this->newss = new Newss();
    }

    /**
     * show list page
     */
    public function index()
    {
        $page = $this->request->has('page') ? intval($this->request->get('page')) : 1;
        $pagination = $this->newss->paginate($page);
        $category = new Categories();
        $categories = $category->getAll();
        $this->setTemplate('main', 'home', compact('pagination', 'categories'));
    }

    /**
     * Create a new record of news
     */
    public function create()
    {
        $data = $this->request->only(['title_ja', 'title_en', 'title_cn', 'news_date', 'category_id', 'file_name', 'url_link']);
        $data = $this->sanitizedData($data);
        if ($this->validate($data)) {
            $fileInput = $_FILES['pdf_link'];
            $this->uploadFile($fileInput, $data);
            unset($data['file_name']);
            $this->newss->create($data);
        }
        redirect('admin/home');
    }

    /**
     * Update a news record
     */
    public function update()
    {
        $id = $this->request->get('id');
        $data = $this->request->only(['title_ja', 'title_en', 'title_cn', 'news_date', 'category_id','file_name', 'url_link']);
        $data = $this->sanitizedData($data);
        if ($this->validate($data)) {
            //get old pdf file to delete
            $news = $this->newss->find($id);
            $oldFile = $news->pdf_link;

            $fileInput = $_FILES['pdf_link'];
            $uploadResult = $this->uploadFile($fileInput, $data);
            //delete old pdf file
            if (!empty($oldFile) && $uploadResult) {
                $pos = mb_strrpos($oldFile, '/');
                $oldFile = mb_substr($oldFile, $pos + 1);
                $oldFile = $this->uploadDir . $oldFile;
                $this->removeFile($oldFile);
            }
            unset($data['file_name']);
            $this->newss->update($id, $data);
        }
        redirect('admin/home');
    }

    /**
     *  Delete an existing record of news
     */
    public function delete()
    {
        $id = $this->request->get('id');
        $news = $this->newss->find($id);
        $oldFile = $news->pdf_link;
        $deleted = $this->newss->delete($id);

        //delete pdf file
        if ($deleted) {
            $pos = mb_strrpos($oldFile, '/');
            $oldFile = mb_substr($oldFile, $pos + 1);
            $oldFile = $this->uploadDir . $oldFile;
            $this->removeFile($oldFile);
        }
        redirect('admin/home');
    }

    /**
     * Get news record by id
     */
    public function getById()
    {
        $id = $this->request->get('id');
        $news = $this->newss->find($id);
        $this->response->setAjaxResponse($news);
    }

    /**
     * Get all news record to be displayed on Frontend pages
     */
    public function getAllNews()
    {
        $lang = $this->request->get('lang');
        $data = $this->newss->getAll($lang);

        //set hyper link to response
        for ($i = 0; $i < count($data); $i ++) {
            if (!empty($data[$i]->pdf_link)) {
                $data[$i]->link = $data[$i]->pdf_link;
            } elseif (!empty($data[$i]->url_link)) {
                $data[$i]->link = $data[$i]->url_link;
            } else {
                $data[$i]->link = null;
            }
            unset($data[$i]->pdf_link);
            unset($data[$i]->url_link);

            //remove record with title is empty
            if (empty(trim($data[$i]->title))) {
                unset($data[$i]);
            }
        }
        $data = array_values($data);
        $this->response->setAjaxResponse($data);
    }

    /**
     * Validate input data
     *
     * @param array $data
     * @return bool
     */
    private function validate(array $data)
    {
        $data = array_map('trim', $data);
        if (empty($data['title_ja']) || empty($data['news_date']) || empty($data['category_id'])
                || (!empty($data['file_name']) && !empty($data['url_link']))) {
            return false;
        }
        return true;
    }

    /**
     * upload file to server
     *
     * @param $fileInput
     * @param $data
     * @return bool
     */
    private function uploadFile($fileInput, &$data)
    {
        $data['pdf_link'] = "";
        if (!empty($fileInput['name'])) {
            //create upload dir if not exists
            if (!is_dir($this->uploadDir)) {
                mkdir($this->uploadDir, 0777, true);
            }

            $newName = time() . '.pdf';
            $tempFile = $fileInput['tmp_name'];
            $destinationFile = $this->uploadDir . $newName;
            $pdfLink = $this->pdfPath . $newName;

            //move upload file to pdf directory
            move_uploaded_file($tempFile, $destinationFile);
            $data['pdf_link'] = $pdfLink;
            return true;
        }
        return false;
    }

    /**
     * remove file
     *
     * @param $path
     */
    private function removeFile($path)
    {
        if (file_exists($path)){
            unlink($path);
        }
    }

    /**
     * sanitized requestData
     *
     * @param array $data
     * @return array
     */
    private function sanitizedData($data)
    {
        $data['title_ja'] = trim($data['title_ja']);
        $data['title_en'] = trim($data['title_en']);
        $data['title_cn'] = trim($data['title_cn']);
        return $data;
    }
}