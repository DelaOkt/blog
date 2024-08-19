<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Post;

class CategoryController extends Controller
{
    public function index() {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }

    public function create() {
        return view('categories.create');
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:categories',
        ]);

        Category::create($request->all());
        return redirect()->route('categories.index');
    }

    public function edit(Category $category) {
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category) {
        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:categories,slug,' . $category->id,
        ]);

        $category->update($request->all());
        return redirect()->route('categories.index');
    }

    public function destroy(Category $category) {
        $category->delete();
        return redirect()->route('categories.index');
    }
    public function showPostsByCategory($slug) {
        // Temukan kategori berdasarkan slug
        $category = Category::where('slug', $slug)->firstOrFail();

        // Ambil postingan yang termasuk dalam kategori tersebut
        $posts = Post::where('category_id', $category->id)->with('user')->get();

        // Tampilkan tampilan dengan postingan dan kategori
        return view('categories.show', compact('posts', 'category'));
    }
    // CategoryController.php
    public function show($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $posts = $category->posts; // Mengambil semua posts yang terkait dengan kategori ini
        
        return view('categories.show', compact('category', 'posts'));
    }
}
