@extends('layouts.app')

@section('content')
<div class="container">
    <form action="{{ route('categories.update', $category) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Nama Kategori</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $category->name }}" oninput="generateSlug()">
        </div>
        <div class="form-group">
            <label for="slug">Slug</label>
            <input type="text" name="slug" id="slug" class="form-control" value="{{ $category->slug }}">
        </div>
        <button class="btn btn-primary mt-3">Update</button>
    </form>
</div>

<script>
    function generateSlug() {
        const name = document.getElementById('name').value;
        const slug = document.getElementById('slug');
        // Mengubah nama menjadi slug dengan menghilangkan spasi dan mengganti dengan tanda hubung
        slug.value = name.toLowerCase().trim().replace(/\s+/g, '-').replace(/[^a-z0-9\-]/g, '');
    }
</script>
@endsection
