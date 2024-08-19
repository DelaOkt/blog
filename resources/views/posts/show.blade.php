@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ $post->title }}</div>

                <div class="card-body">
                    <h1>{{ $post->title }}</h1>
                    <p class="text-muted">
                        Diposting oleh {{ $post->user->name }} pada {{ $post->created_at->format('d M Y') }}
                    </p>
                    <p class="text-muted">
                        Kategori: <a href="{{ route('category.posts', $post->category->slug) }}">{{ $post->category->name }}</a>
                    </p>
                    <p>{{ $post->content }}</p>

                    <!-- Tombol untuk kembali ke beranda -->
                    <a href="{{ route('home') }}" class="btn btn-secondary">Kembali ke Beranda</a>
                    <a href="{{ route('posts.index') }}" class="btn btn-secondary">Halaman Post</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
