<?php

// app/Http/Controllers/WelcomeController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        return view('welcome'); // Menunjuk ke file welcome.blade.php
    }
}
