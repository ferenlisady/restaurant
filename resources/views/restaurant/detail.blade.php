@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mt-4">
        <div class="col-md-4">
            <img src="{{ asset($restaurant->image) }}" alt="{{ $restaurant->name }}" class="img-fluid"
                style="width: 100%">
        </div>

        <div class="col-md-8 mt-4">
            <h1>{{ $restaurant->name }}</h1>
            <h3>{{ $restaurant->address }}</h3>
            <p>{{ $restaurant->description }}</p>
        </div>
    </div>

    <div class="row mt-5">
        <h2>Menu</h2>
        @foreach ($restaurant->menus as $menu)
            <div class="col-md-4 mb-3">
                <div class="card">
                    <img src="{{ asset($menu->image) }}" class="card-img-top" style="height: 300px;"
                        alt="{{ $menu->name }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $menu->name }}</h5>
                        <p class="card-text">{{ Str::limit($menu->description, 100) }}</p>
                        <h5 class="card-text">${{ $menu->price }}</h5>
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('menu.detail', $menu->id) }}" class="btn btn-success">View Details</a>

                            <form action="{{ route('order.add', $menu->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary">Add to Order</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection