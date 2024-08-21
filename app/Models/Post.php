<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'content',
        'category_id',
        'file', // Tambahkan ini jika Anda menyimpan file
        'user_id', // Menambahkan kolom user_id
    ];

    // Mutator untuk membuat slug otomatis
    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    // Definisikan relasi dengan Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Definisikan relasi dengan User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
