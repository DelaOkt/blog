<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Mengambil semua kategori dan post untuk ditampilkan di halaman beranda
        $categories = Category::all();
        $posts = Post::with('category', 'user')->latest()->get();
        
        // Jika user sudah login, ambil data pengguna
        $user = auth()->check() ? auth()->user() : null;

        // Mengirimkan data ke view home
        return view('home', compact('categories', 'posts', 'user'));
    }
}
