<?php

namespace App\Models;


class Category extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'categories';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Category constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }
}