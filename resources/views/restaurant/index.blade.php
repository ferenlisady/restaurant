@extends('layouts.app')

@section('content')
<div class="container">
    <form method="GET" action="{{ route('restaurant.index') }}">
        <input type="text" name="search" placeholder="Search Menu" class="form-control mb-3">
    </form>

    <div class="row mb-5">
        @foreach ($restaurants as $restaurant)
            <div class="col-md-4">
                <div class="card">
                    <img src="{{ asset($restaurant->image) }}" class="card-img-top" alt="{{ $restaurant->name }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $restaurant->name }}</h5>
                        <p class="card-text">{{ $restaurant->description }}</p>
                        <h6>Address: {{ $restaurant->address }}</h6>
                        <a href="{{ route('restaurant.detail', $restaurant->id) }}" class="btn btn-success">View Details</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection