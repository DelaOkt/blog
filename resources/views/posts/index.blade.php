@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Posts') }}</div>

                <div class="card-body">
                    <a href="{{ route('posts.create') }}" class="btn btn-primary mb-3">Create New Post</a>

                    @if ($posts->count())
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($posts as $post)
                                    <tr>
                                        <td>{{ $post->title }}</td>
                                        <td>{{ $post->category->name }}</td>
                                        <td>
                                            <a href="{{ route('posts.show', $post->slug) }}" class="btn btn-info btn-sm">View</a>
                                            <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                            <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger btn-sm">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p>No posts found.</p>
                    @endif
                    @foreach ($posts as $post)
    <h2><a href="{{ route('posts.show', $post->id) }}">{{ $post->title }}</a></h2>
@endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
