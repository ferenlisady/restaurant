@extends('layouts.app')

@section('content')
<div class="container">
    <form method="GET" action="{{ route('menu.index') }}" class="mb-3">
        <div class="row">
            <div class="col-md-8">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search Menu"
                    class="form-control">
            </div>
            <div class="col-md-4">
                <select name="sort" class="form-select" onchange="this.form.submit()">
                    <option value="" disabled selected>Sort By Price</option>
                    <option value="asc" {{ request('sort') === 'asc' ? 'selected' : '' }}>Low to High</option>
                    <option value="desc" {{ request('sort') === 'desc' ? 'selected' : '' }}>High to Low</option>
                </select>
            </div>
        </div>
    </form>

    <div class="row mb-5">
        @foreach ($menus as $menu)
            <div class="col-md-4">
                <div class="card">
                    <img src="{{ asset($menu->image) }}" class="card-img-top" style="height: 300px;"
                        alt="{{ $menu->name }}">
                    <div class="card-body">
                        <h4 class="card-title">{{ $menu->name }}</h4>
                        <p class="card-text">{{ Str::limit($menu->description, 100) }}</p>
                        <h5 class="card-text">$ {{ $menu->price }}</h5>

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

    <div class="d-flex justify-content-center mb-4">
        <span class="me-2 fw-bold">Page | </span>
        <span class="me-2">
            @for ($i = 1; $i <= $menus->lastPage(); $i++)
                <a href="{{ $menus->url($i) }}"
                    class="mx-1 {{ $i === $menus->currentPage() ? 'text-dark fw-bold' : 'text-muted' }}"
                    style="text-decoration: none;">{{ $i }}</a>
            @endfor
        </span>
    </div>
</div>
@endsection