<?php

namespace App\System;


class Response
{

    /**
     * Return json data to the Browser (client)
     * @param $data
     */
    public function setAjaxResponse($data)
    {
        header('Content-Type: application/json');
        echo json_encode($data);
        exit(0);
    }
}