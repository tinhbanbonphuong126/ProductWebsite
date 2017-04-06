<?php

namespace App\Controllers;


class HomeController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        var_dump('homepage');
    }
}