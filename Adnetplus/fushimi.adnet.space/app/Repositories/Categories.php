<?php

namespace App\Repositories;

use App\Models\Category;

class Categories
{
    /**
     * Get all categories
     *
     * @return mixed
     */
    public function getAll()
    {
        return Category::all();
    }
}