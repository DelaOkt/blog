<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Metode index untuk menampilkan daftar pengguna
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
        $user = auth()->user();
        return view('layouts.app', compact('user'));
    }
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('users.show', compact('user'));
        
    }
    public function create()
    {
        
        return view('users.create'); 
    }
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Buat user baru
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Redirect ke halaman index users dengan pesan sukses
        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }
    public function update(Request $request, $id)
{
    $user = User::findOrFail($id);
    
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        'password' => 'nullable|string|min:8|confirmed',
    ]);
    
    $user->name = $request->input('name');
    $user->email = $request->input('email');
    
    if ($request->filled('password')) {
        $user->password = bcrypt($request->input('password'));
    }
    
    $user->save();

    return redirect()->route('users.index')->with('success', 'User updated successfully.');
}


public function destroy(User $user)
{
    // Hapus data pengguna
    $user->delete();

    // Redirect setelah hapus
    return redirect()->route('users.index')->with('success', 'User deleted successfully!');
}

}