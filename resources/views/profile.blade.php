@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <!-- Left Section: Profile Details -->
        <div class="col-md-4 mt-5 ps-5">
            <img src="{{ asset('assets/default-profile.png') }}" class="img-fluid rounded-circle mb-4"
                style="width: 50%;" alt="Profile Picture">
            <h4>{{ $user->name }}</h4>
            <p>{{ $user->email }}</p>
            <p>Joined on: {{ $user->created_at->format('d M Y') }}</p>
        </div>

        <!-- Right Section: Update Profile -->
        <div class="col-md-8 mt-5">
            <h2>Update Profile</h2>
            <form action="{{ route('profile.update') }}" method="POST" class="mb-4">
                @csrf
                @method('PUT')

                {{-- Display Validation Errors --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $user->name) }}"
                        required>
                    @error('name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" id="email" name="email" class="form-control"
                        value="{{ old('email', $user->email) }}" required>
                    @error('email')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" id="password" name="password" class="form-control"
                        placeholder="Leave blank to keep current password">
                    @error('password')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control"
                        placeholder="Leave blank to keep current password">
                </div>

                <button type="submit" class="btn btn-primary">Update Profile</button>
            </form>

            {{-- Display Success Message --}}
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection