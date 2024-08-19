@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Jumbotron Header -->
    <div class="jumbotron jumbotron-fluid bg-primary text-white text-center py-5 mb-4">
        <div class="container">
            <h1 class="display-4">Kategori: {{ $category->name }}</h1>
            <p class="lead">Menampilkan semua postingan di kategori ini.</p>
        </div>
    </div>

    <!-- Blog Posts -->
    <div class="row">
        @forelse($posts as $post)
            <div class="col-md-6 mb-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h2 class="card-title">{{ $post->title }}</h2>
                        <p class="text-muted">
                            Diposting oleh {{ $post->user->name }} pada {{ $post->created_at->format('d M Y') }}
                        </p>
                        <p class="text-muted">
                            Kategori: {{ $category->name }}
                        </p>
                        <p class="card-text">{{ Str::limit($post->content, 150, '...') }}</p>
                        <a href="{{ route('posts.show', $post->slug) }}" class="btn btn-primary">Baca Selengkapnya</a>
                    </div>
                </div>
            </div>
        @empty
            <p>Belum ada postingan di kategori ini.</p>
        @endforelse
    </div>
</div>
@endsection
