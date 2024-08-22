<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class HomeController extends Controller
{
    public function index()
    {
        // Mendapatkan pengguna yang sedang login
        $user = auth()->user();
        
        // Jika pengguna tidak login, redirect ke halaman login atau tampilkan pesan error
        if (!$user) {
            return redirect()->route('login')->with('error', 'You must be logged in to view this page.');
        }

        // Jika pengguna adalah admin, tampilkan semua post
        if ($user->isAdmin()) {
            $posts = Post::all();
        } else {
            // Jika pengguna adalah user, tampilkan hanya post milik pengguna
            $posts = Post::where('user_id', $user->id)->get();
        }

        return view('home', compact('posts'));
    }
}

