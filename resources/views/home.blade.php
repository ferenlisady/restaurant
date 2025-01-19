@extends('layouts.app')

@section('content')
<div class="container">
    <!-- <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div> -->

    <section class="text-white text-center py-5 mb-5"
        style="background: url('{{ asset('assets/banner.png') }}') no-repeat center center; background-size: cover;">
        <div class="container">
            <h1 class="display-4">Welcome to Our Restaurant</h1>
            <p class="lead">Explore our delicious menu and enjoy the finest food.</p>
            <a href="{{ route('menu.index') }}" class="btn btn-light btn-lg">See Our Menu</a>
        </div>
    </section>

    <div class="container">
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
</div>
@endsection