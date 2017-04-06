<?php

namespace App\Repositories;

use App\Models\Topic;

class Topics
{
    /**
     * Get all topics records by language
     *
     * @param $lang
     * @return mixed
     */
    public function getAll($lang)
    {
        if (!in_array($lang, ['ja', 'en', 'cn'])) $lang = 'ja';
        $title = "title_$lang AS title";
        $pdfLink = "pdf_link";
        $urlLink = "url_link";
        $sql = "SELECT id, $title, $pdfLink, $urlLink, DATE_FORMAT(topic_date,'%Y.%m.%d') AS topic_date FROM topics ORDER BY topic_date DESC";
        $records = Topic::query($sql);
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
        $totalRecord = Topic::countAll();
        $pages = (int)($totalRecord / $perPage) + ($totalRecord % $perPage === 0 ? 0 : 1);
        $startRec = ($page - 1) * $perPage;
        //$sql = "SELECT id, title_ja AS title, topic_date FROM topics ORDER BY topic_date DESC LIMIT {$startRec}, {$perPage}";
        $sql = <<<SQL
SELECT 
      t.id,
      t.title_ja AS title,
      t.topic_date, 
      c.name_ja AS category 
FROM 
      topics AS t 
INNER JOIN 
      categories AS c 
ON 
      t.category_id = c.id
ORDER BY 
      t.topic_date DESC
LIMIT 
      {$startRec}, {$perPage}
SQL;
        $records = Topic::query($sql);
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
        $data['topic_date'] = dateFormat($data['topic_date'], 'Y.m.d', 'Y-m-d');
        $data['created_at'] = date('Y-m-d H:i:s');
        return Topic::create($data);
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
        $data['topic_date'] = dateFormat($data['topic_date'], 'Y.m.d', 'Y-m-d');
        $data['updated_at'] = date('Y-m-d H:i:s');
        return Topic::update($id, $data);
    }

    /**
     * Delete an existing record by id
     *
     * @param $id
     * @return bool|mixed
     */
    public function delete($id)
    {
        $news = Topic::find($id);
        return $news ? Topic::delete($id) : false;
    }

    /**
     * Find an existing record by id
     *
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        $record = Topic::find($id);
        return $record;
    }
}