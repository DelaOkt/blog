<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    // Menampilkan daftar post
    public function index()
{
    if (auth()->user()->isAdmin()) {
        // Admin dapat melihat semua post
        $posts = Post::all();
    } else {
        // User biasa hanya melihat post yang mereka miliki
        $posts = Post::where('user_id', auth()->id())->get();
    }

    return view('posts.index', compact('posts'));
}


    // Menampilkan halaman untuk membuat post baru
    public function create()
    {
        $categories = Category::all();
        return view('posts.create', compact('categories'));
    }

    // Menyimpan post baru
    public function store(Request $request)
{
    $request->validate([
        'title' => 'required',
        'slug' => 'required|unique:posts',
        'content' => 'required',
        'category_id' => 'required',
        'date' => 'required|date', // Validasi untuk tanggal
        'file' => 'nullable|mimes:jpg,png,pdf,doc,docx|max:2048',
    ]);

    $post = new Post();
    $post->title = $request->title;
    $post->slug = $request->slug;
    $post->content = $request->content;
    $post->category_id = $request->category_id;
    $post->user_id = auth()->user()->id;
    $post->date = $request->date; // Menyimpan tanggal

    // File upload logic
    if ($request->hasFile('file')) {
        $fileName = time().'.'.$request->file->extension();
        $request->file->move(public_path('uploads'), $fileName);
        $post->file = $fileName;
    }

    $post->save();

    return redirect()->route('posts.index')->with('success', 'Post created successfully!');
}

    // Menampilkan halaman edit post
    public function edit(Post $post)
    {
        $categories = Category::all();
        return view('posts.edit', compact('post', 'categories'));
    }

    // Mengupdate post
    public function update(Request $request, Post $post)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'category_id' => 'required|exists:categories,id',
        'slug' => 'required|string|max:255|unique:posts,slug,' . $post->id,
        'content' => 'required',
        'file' => 'nullable|mimes:jpg,png,doc,pdf|max:2048',
    ]);

    $post->title = $request->input('title');
    $post->category_id = $request->input('category_id');
    $post->slug = $request->input('slug');
    $post->content = $request->input('content');

    if ($request->hasFile('file')) {
        $file = $request->file('file');
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('uploads'), $filename);

        // Hapus file lama jika ada
        if ($post->file) {
            $oldFile = public_path('uploads/' . $post->file);
            if (file_exists($oldFile)) {
                unlink($oldFile);
            }
        }

        $post->file = $filename;
    }

    $post->save();

    return redirect()->route('posts.index')->with('success', 'Post updated successfully.');
}


    // Menghapus post
    public function destroy(Post $post)
    {
        // Hapus file jika ada
        if ($post->file && file_exists(public_path('uploads/' . $post->file))) {
            unlink(public_path('uploads/' . $post->file));
        }

        $post->delete();
        return redirect()->route('posts.index');
    }

    // Menampilkan detail post
    public function show($slug)
{
    $post = Post::where('slug', $slug)->firstOrFail();
    return view('posts.show', compact('post'));
}

}
