<?php

namespace App\Repositories;

use App\Models\Administrator;

class Administrators
{
    /**
     * Administrators constructor.
     */
    public function __construct()
    {
    }

    /**
     * Check login
     *
     * @param $code
     * @param $password
     * @return mixed
     */
    public function login($code, $password)
    {
        $record = Administrator::whereEquals(['code' => $code, 'password' => $password], false);
        return $record;
    }

    public function find($id)
    {
        return Administrator::find($id);
    }
}