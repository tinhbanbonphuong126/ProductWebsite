<?php

namespace App\Controllers\Admin;

use App\Repositories\Categories;
use App\Repositories\Topics;

class TopicsController extends Controller
{
    private $topics;
    private $uploadDir = UPLOAD_DIR . 'pdf/';
    private $pdfPath = '/public/uploads/pdf/';

    /**
     * TopicsController constructor.
     */
    public function __construct()
    {
        parent::__construct();
        if (!$this->request->is('ajax')) {
            $this->checkUserLoggedIn();
        }
        $this->topics = new Topics();
    }

    /**
     * show list page
     */
    public function index()
    {
        $page = $this->request->has('page') ? intval($this->request->get('page')) : 1;
        $pagination = $this->topics->paginate($page);
        $category = new Categories();
        $categories = $category->getAll();
        $this->setTemplate('main', 'topic', compact('pagination', 'categories'));
    }

    /**
     * Create a new record of news
     */
    public function create()
    {
        $data = $this->request->only(['title_ja', 'topic_date', 'category_id', 'file_name', 'url_link']);
        $data = $this->sanitizedData($data);
        if ($this->validate($data)) {
            $fileInput = $_FILES['pdf_link'];
            $this->uploadFile($fileInput, $data);
            unset($data['file_name']);
            $this->topics->create($data);
        }
        redirect('admin/topic');
    }

    /**
     * Update a news record
     */
    public function update()
    {
        $id = $this->request->get('id');
        $data = $this->request->only(['title_ja', 'topic_date', 'category_id', 'file_name', 'url_link']);
        $data = $this->sanitizedData($data);
        if ($this->validate($data)) {
            //get old pdf file to delete
            $topic = $this->topics->find($id);
            $oldFile = $topic->pdf_link;

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
            $this->topics->update($id, $data);
        }
        redirect('admin/topic');
    }

    /**
     *  Delete an existing record of news
     */
    public function delete()
    {
        $id = $this->request->get('id');
        $topic = $this->topics->find($id);
        $oldFile = $topic->pdf_link;
        $deleted = $this->topics->delete($id);

        //delete pdf file
        if ($deleted) {
            $pos = mb_strrpos($oldFile, '/');
            $oldFile = mb_substr($oldFile, $pos + 1);
            $oldFile = $this->uploadDir . $oldFile;
            $this->removeFile($oldFile);
        }
        redirect('admin/topic');
    }

    /**
     * Get news record by id
     */
    public function getById()
    {
        $id = $this->request->get('id');
        $news = $this->topics->find($id);
        $this->response->setAjaxResponse($news);
    }


    /**
     * Get all topics record to be displayed on Frontend pages
     */
    public function getAllTopics()
    {
        $lang = $this->request->get('lang');
        $data = $this->topics->getAll($lang);
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
        }
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
        if (empty($data['title_ja']) || empty($data['topic_date'])) {
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
        return $data;
    }
}