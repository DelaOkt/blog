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
                    <p class="text-muted">
                        Terakhir diperbarui pada {{ $post->updated_at->format('d M Y H:i') }}
                    </p>
                    <p>{{ $post->content }}</p>

                    @if ($post->file)
                        <div class="mt-3">
                            <p>Uploaded File:</p>
                            <a href="{{ asset('uploads/' . $post->file) }}" target="_blank">{{ $post->file }}</a>
                        </div>
                    @endif

                    <!-- Tombol untuk kembali ke beranda -->
                    <a href="{{ route('home') }}" class="btn btn-secondary">Kembali ke Beranda</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
