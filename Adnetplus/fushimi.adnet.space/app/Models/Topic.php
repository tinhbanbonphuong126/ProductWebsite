<?php

namespace App\Models;


class Topic extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'topics';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Topic constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }
}