<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        // Pastikan hanya admin yang bisa mengakses controller ini dengan middleware 'admin'
        $this->middleware(['auth', 'admin']);
    }

    public function index()
    {
        // Ini adalah halaman dashboard admin
        return view('admin.dashboard');
    }
}
