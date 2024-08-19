<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // Kirim data ke view beranda
    $posts = Post::with('category', 'user')->latest()->get();
    return view('home', compact('posts'));
  
    $user = auth()->user(); // ambil pengguna yang sedang login

    return view('home', ['user' => $user]);
}

}