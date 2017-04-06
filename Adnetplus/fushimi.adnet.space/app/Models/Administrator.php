<?php

namespace App\Models;


class Administrator extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'administrators';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Administrator constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }
}