@extends('layouts.app')

@section('content')
<div class="container">
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('categories.store') }}" method="POST" id="category-form">
        @csrf
        <div class="form-group">
            <label for="name">Nama Kategori</label>
            <input type="text" name="name" id="name" class="form-control">
        </div>
        <div class="form-group">
            <label for="slug">Slug</label>
            <input type="text" name="slug" id="slug" class="form-control" readonly>
            <span id="slug-error" class="text-danger"></span>
        </div>
        <button class="btn btn-primary mt-3" type="submit">Simpan</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#name').on('input', function() {
            var name = $(this).val();
            var slug = name.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/^-+|-+$/g, '');
            $('#slug').val(slug);
            checkSlug(slug);
        });

        function checkSlug(slug) {
            $.ajax({
                url: "{{ route('categories.checkSlug') }}",
                method: 'GET',
                data: { slug: slug },
                success: function(response) {
                    if (response.exists) {
                        $('#slug-error').text('Slug sudah digunakan.');
                    } else {
                        $('#slug-error').text('');
                    }
                }
            });
        }
    });
</script>
@endsection
