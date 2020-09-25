<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
    public function show(Category $category)
    {
        $posts = $category->posts()->paginate(6);

        return view('posts.index', [
            'posts' => $posts,
            'category' => $category,
        ]);
    }
}
