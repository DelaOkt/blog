@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Users') }}</div>

                <div class="card-body">
                    <a href="{{ route('users.create') }}" class="btn btn-primary mb-3">Create New User</a>

                    @if ($users->count())
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->role }}</td>
                                        <td>
                                            <a href="{{ route('users.show', $user->id) }}" class="btn btn-info btn-sm">View</a>
                                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline">
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
                        <p>No users found.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
