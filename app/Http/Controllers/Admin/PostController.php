<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::OrderBy('created_at', 'ASC')->paginate(4);

        return view('admin.post.index', [
            'posts' => $posts
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::OrderBy('created_at', 'ASC')->get();

        return view('admin.post.create', [
            'categories' => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $post = new Post();
        $post->title = $request->title;
        $post->text = $request->text;
        $post->image = $request->image;
        $post->cat_id = $request->cat_id;
        $post->user_id = $request->user_id;
        $post->save();

        return redirect()->back()->withSuccess('Пост добавлен');
    }

    /**
     * Display the specified resource.
     */
    public function indexnews()
    {
        $categories = Category::OrderBy('created_at', 'ASC')->get();
        return view('nav.news', [
            'categories' => $categories
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $categories = Category::OrderBy('created_at', 'ASC')->get();

        return view('admin.post.edit', [
            'categories' => $categories,
            'post' => $post,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $post->title = $request->title;
        $post->text = $request->text;
        $post->image = $request->image;
        $post->cat_id = $request->cat_id;
        $post->user_id = $request->user_id;
        $post->save();

        return redirect()->back()->withSuccess('Пост обновлён');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->back()->withSuccess('Пост удален');
    }
}
