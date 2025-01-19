@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Add New Menu</h1>

    <form action="{{ route('menu.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Menu Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="number" class="form-control" id="price" name="price" step="0.01" required>
        </div>

        <div class="mb-3">
            <label for="restaurant_id" class="form-label">Restaurant</label>
            <select class="form-control" id="restaurant_id" name="restaurant_id" required>
                @foreach ($restaurants as $restaurant)
                    <option value="{{ $restaurant->id }}">{{ $restaurant->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Image URL</label>
            <input type="text" class="form-control" id="image" name="image">
        </div>

        <button type="submit" class="btn btn-success">Add Menu</button>
    </form>
</div>
@endsection