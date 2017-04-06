<?php

namespace App\Models;


class News extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'news';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * News constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }
}