<?php

namespace App\Http\Controllers\Web;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function categories()
    {
        return view('dashboard.categories');
    }

    public function edit(Category $category)
    {
        return view(view: 'dashboard.categories.edit')->with([
            'category' => $category
        ]);
    }
}
