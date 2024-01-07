<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::orderBy('created_at', 'ASC')->get();
        $categories_first = Category::orderBy('created_at', 'ASC')->first();
        $posts = DB::table('posts')->where('cat_id', $categories_first['id'])->orderBy('created_at', 'DESC')->paginate(3);

        foreach ($posts as $post) {
            $post->username = DB::table('users')->where('id', $post->user_id)->value('name');
        }

        return view('user.news', [
            'categories' => $categories,
            'posts' => $posts
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function show(int $cat_id)
    {
        $posts = DB::table('posts')->where('cat_id', "$cat_id")->OrderBy('created_at', 'DESC')->paginate(3);
        $categories = Category::OrderBy('created_at', 'ASC')->get();

        foreach ($posts as $post) {
            $post->username = DB::table('users')->where('id', $post->user_id)->value('name');
        }

        return view('user.news', [
            'categories' => $categories,
            'posts' => $posts
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
