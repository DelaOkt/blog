@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">User Details</h1>

    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">User Information</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <strong>Name:</strong>
                        </div>
                        <div class="col-md-8">
                            {{ $user->name }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <strong>Email:</strong>
                        </div>
                        <div class="col-md-8">
                            {{ $user->email }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <strong>Role:</strong>
                        </div>
                        <div class="col-md-8">
                            {{ $user->role }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <strong>Last Updated:</strong>
                        </div>
                        <div class="col-md-8">
                            {{ $user->updated_at->format('d M Y H:i') }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <strong>Number of Posts:</strong>
                        </div>
                        <div class="col-md-8">
                            {{ $user->posts->count() }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <strong>Account Status:</strong>
                        </div>
                        <div class="col-md-8">
                            {{ $user->status == 1 ? 'Active' : 'Inactive' }}
                        </div>
                    </div>
                </div>
                <div class="card-footer text-end">
                    <a href="{{ route('users.index') }}" class="btn btn-secondary">Back to List</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
