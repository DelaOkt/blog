<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PostController extends Controller
{
    public function index() {
        $posts = Post::with('category')->get();
        return view('posts.index', compact('posts'));
    }

    public function create() {
        $categories = Category::all();
        return view('posts.create', compact('categories'));
    }

    public function store(Request $request) {
        // Validasi dan simpan data
        $request->validate([
            'title' => 'required',
            'slug' => 'required|unique:posts',
            'content' => 'required',
            'category_id' => 'required',
            'date' => 'required|date',
        ]);
    
        $post = new Post($request->all());
        $post->user_id = auth()->user()->id;
        $post->save();
    
        // Redirect ke halaman index
        return redirect()->route('posts.index');
    }    
    

    public function edit(Post $post) {
        $categories = Category::all();
        return view('posts.edit', compact('post', 'categories'));
    }

    public function update(Request $request, Post $post) {
        $request->validate([
            'title' => 'required',
            'slug' => 'required|unique:posts,slug,' . $post->id,
            'content' => 'required',
            'category_id' => 'required',
            'date' => 'required|date',
        ]);

        $post->update($request->all());

        return redirect()->route('posts.index');
    }

    public function destroy(Post $post) {
        $post->delete();
        return redirect()->route('posts.index');
    }
    public function __construct()
{
    $this->middleware('auth');
}
public function show($slug) {
    // Temukan post berdasarkan slug
    $post = Post::where('slug', $slug)->with('user', 'category')->firstOrFail();

    // Kembalikan view dengan post
    return view('posts.show', compact('post'));
}

}
