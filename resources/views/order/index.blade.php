@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Your Orders</h1>

    @if($orders->isEmpty())
        <div class="alert alert-warning" role="alert">
            You have no orders yet.
        </div>
    @else
        <table class="table table-striped">
            <thead>
                <tr>
                    <th></th>
                    <th>Menu Name</th>
                    <th>Price</th>
                    <th>Ordered At</th>
                    <th>Quantity</th>
                    <th>Total Price</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $order->menu->name }}</td>
                        <td>$ {{ number_format($order->menu->price, 2) }}</td>
                        <td>{{ $order->created_at->format('d M Y, H:i') }}</td>
                        <td>
                            <form action="{{ route('order.updateQuantity', $order->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="d-flex align-items-center">
                                    <button type="submit" name="quantity" value="{{ max(1, $order->quantity - 1) }}" class="btn btn-warning btn-sm" {{ $order->quantity == 1 ? 'disabled' : '' }}>-</button>
                                    <input type="number" class="form-control mx-2" name="quantity" value="{{ $order->quantity }}" min="1" style="width: 60px;" disabled>
                                    <button type="submit" name="quantity" value="{{ $order->quantity + 1 }}" class="btn btn-success btn-sm">+</button>
                                </div>
                            </form>
                        </td>
                        <td>
                            $ {{ number_format($order->quantity * $order->menu->price, 2) }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">
            <h4 class="fw-bold">Total Amount: $ {{ number_format($totalAmount, 2) }}</h4>
        </div>
    @endif
</div>
@endsection
