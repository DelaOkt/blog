@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Jumbotron Header -->
    <div class="jumbotron jumbotron-fluid bg-primary text-white text-center py-5 mb-4">
        <div class="container">
            <h1 class="display-4">Selamat Datang di Blog Kami</h1>
            <p class="lead">Temukan informasi menarik dan terbaru di sini</p>
        </div>
    </div>

    <!-- Blog Posts -->
    <div class="row">
        @foreach($posts as $post)
            <div class="col-md-6 mb-4">
                <div class="card h-100 shadow-sm">
                    @if ($post->file)
                        <img src="{{ asset('uploads/' . $post->file) }}" class="card-img-top" alt="{{ $post->title }}" style="height: 200px; object-fit: cover;">
                    @endif
                    <div class="card-body">
                        <h2 class="card-title">{{ $post->title }}</h2>
                        <p class="text-muted">
                            Diposting oleh {{ $post->user->name }} pada {{ $post->created_at->format('d M Y') }}
                        </p>
                        <p class="text-muted">
                            Kategori: <a href="{{ route('category.posts', $post->category->slug) }}" class="text-decoration-none">{{ $post->category->name }}</a>
                        </p>
                        <p class="card-text">{{ Str::limit($post->content, 150, '...') }}</p>
                        <a href="{{ route('posts.show', $post->slug) }}" class="btn btn-primary">Baca Selengkapnya</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
