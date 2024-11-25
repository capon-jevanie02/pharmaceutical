@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit User</h2>

    <!-- Display validation errors -->
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Update User Form -->
    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT') <!-- Simulate PUT method -->

        <!-- Name Field -->
        <div class="form-group mb-3">
            <label for="name">Name</label>
            <input 
                type="text" 
                class="form-control" 
                id="name" 
                name="name" 
                value="{{ old('name', $user->name) }}" 
                required
            >
        </div>

        <!-- Email Field -->
        <div class="form-group mb-3">
            <label for="email">Email</label>
            <input 
                type="email" 
                class="form-control" 
                id="email" 
                name="email" 
                value="{{ old('email', $user->email) }}" 
                required
            >
        </div>

        <!-- Role Field -->
        <div class="form-group mb-3">
            <label for="role">Role</label>
            <select name="role" id="role" class="form-control">
                <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>User</option>
            </select>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-success">Update User</button>
    </form>
</div>
@endsection
