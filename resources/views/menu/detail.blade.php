@extends('layouts.app')

@section('content')
<div class="container">
    <img src="{{ $menu->image ? asset($menu->image) : asset('assets/default.jpg') }}" 
    class="card-img-top mt-5 mb-4"
        style="height: 300px; width:100%; border-radius: 10px;" alt="{{ $menu->name }}">

    <h4 class="card-title">{{ $menu->name }}</h4>
    <p class="card-text">{{ Str::limit($menu->description, 100) }}</p>
    <h5 class="card-text">$ {{ $menu->price }}</h5>
    <form action="{{ route('order.add', $menu->id) }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-primary">Add to Order</button>
    </form>
</div>
@endsection