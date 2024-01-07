<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::orderBy('created_at', 'asc')->paginate(1);

        return view('admin.category.index', [
            'categories' => $categories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $category = new Category();
        $category->title = $request->title;
        $category->save();
        return redirect()->back()->withSuccess('Категория добавлена');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return view('admin.category.edit', [
            'category' => $category
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('admin.category.edit', [
            'category' => $category
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $category->title = $request->title;
        $category->save();
        return redirect()->back()->withSuccess('Категория обновлена');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->back()->withSuccess('Категория удалена');
    }
}
