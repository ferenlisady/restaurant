@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Add New Restaurant</h1>
    <form action="{{ route('restaurant.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Restaurant Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
            @error('name')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="image">Image (must start with "assets/")</label>
            <input type="text" name="image" id="image" class="form-control" value="{{ old('image') }}">
            @error('image')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control" rows="4" required>{{ old('description') }}</textarea>
            @error('description')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="address">Address</label>
            <input type="text" name="address" id="address" class="form-control" value="{{ old('address') }}" required>
            @error('address')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Add Restaurant</button>
    </form>
</div>
@endsection
