<?php

namespace App\Repositories;

use App\Models\News;

class Newss
{

    /**
     * Get all news records by language
     *
     * @param $lang
     * @return mixed
     */
    public function getAll($lang)
    {
        if (!in_array($lang, ['ja', 'en', 'cn'])) $lang = 'ja';
        $title = "n.title_$lang AS title";
        $pdfLink = "n.pdf_link AS pdf_link";
        $urlLink = "n.url_link AS url_link";
        $categoryName = "c.name_$lang AS category_name";
        $sql = <<<SQL
SELECT 
    $title, 
    DATE_FORMAT(n.news_date,'%Y.%m.%d') AS news_date, 
    n.category_id,
    $categoryName,
    $pdfLink,
    $urlLink,
    IF(n.category_id = 1, 'orange', 'pink') AS class
FROM
    news AS n 
INNER JOIN 
    categories AS c 
ON 
    n.category_id = c.id 
ORDER BY 
    n.news_date DESC
SQL;
        $records = News::query($sql);
        return $records;
    }

    /**
     * Get data for pagination
     *
     * @param int $page
     * @return array
     */
    public function paginate($page = 1)
    {
        $perPage = PER_PAGE;
        $totalRecord = News::countAll();
        $pages = (int)($totalRecord / $perPage) + ($totalRecord % $perPage === 0 ? 0 : 1);
        $startRec = ($page - 1) * $perPage;
        $sql = <<<SQL
SELECT 
      n.id,
      n.title_ja AS title,
      n.news_date, 
      c.name_ja AS category 
FROM 
      news AS n 
INNER JOIN 
      categories AS c 
ON 
      n.category_id = c.id
ORDER BY 
      n.news_date DESC
LIMIT 
      {$startRec}, {$perPage}
SQL;
        $records = News::query($sql);
        $data = [
            'total_record' => $totalRecord,
            'total_pages' => $pages,
            'current_page' => $page,
            'data' => $records
        ];
        return $data;
    }

    /**
     * Create a new record
     *
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        $data['news_date'] = dateFormat($data['news_date'], 'Y.m.d', 'Y-m-d');
        $data['created_at'] = date('Y-m-d H:i:s');
        return News::create($data);
    }

    /**
     * Update an existing record by id
     *
     * @param $id
     * @param array $data
     * @return mixed
     */
    public function update($id, array $data)
    {
        $data['news_date'] = dateFormat($data['news_date'], 'Y.m.d', 'Y-m-d');
        $data['updated_at'] = date('Y-m-d H:i:s');
        return News::update($id, $data);
    }

    /**
     * Delete an existing record by id
     *
     * @param $id
     * @return bool|mixed
     */
    public function delete($id)
    {
        $news = News::find($id);
        return $news ? News::delete($id) : false;
    }

    /**
     * Find an existing record by id
     *
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        $record = News::find($id);
        return $record;
    }
}