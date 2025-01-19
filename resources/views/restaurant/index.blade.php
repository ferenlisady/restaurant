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

                        @if(Auth::user()->role == 'admin')
                            <form action="{{ route('restaurant.destroy', $restaurant->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="d-flex justify-content-center mb-4">
        <span class="me-2 fw-bold">Page | </span>
        <span class="me-2">
            @for ($i = 1; $i <= $restaurants->lastPage(); $i++)
                <a href="{{ $restaurants->url($i) }}"
                    class="mx-1 {{ $i === $restaurants->currentPage() ? 'text-dark fw-bold' : 'text-muted' }}"
                    style="text-decoration: none;">{{ $i }}</a>
            @endfor
        </span>
    </div>
</div>
@endsection