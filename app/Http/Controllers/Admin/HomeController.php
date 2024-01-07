<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() 
    {
        $users_count = User::all()->count();
        $posts_count = Post::all()->count();
        $category_count = Category::all()->count();

        return view('admin.home.index', [
            'users_count' => $users_count,
            'posts_count' => $posts_count,
            'category_count' => $category_count,
        ]);
    }
}
