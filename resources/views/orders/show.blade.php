
@extends('layout')

@section('content')
<div class="container mt-4">
    <h1>Order Details</h1>

    <!-- Order Information -->
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">Order #{{ $order->id }}</h5>
            <p class="card-text">Status: {{ $order->status }}</p>
            <p class="card-text">Total: ${{ $order->total }}</p>
            <p class="card-text">Created At: {{ $order->created_at }}</p>
        </div>
    </div>

    <!-- Order Items -->
    <h2>Order Items</h2>
    <div class="row">
        @foreach($order->orderItems as $orderItem)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $orderItem->product->name }}</h5>
                        <p class="card-text">Price: ${{ $orderItem->price }}</p>
                        <p class="card-text">Quantity: {{ $orderItem->quantity }}</p>
                        <p class="card-text">Subtotal: ${{ $orderItem->price * $orderItem->quantity }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Back to Orders Button -->
    <button onclick="history.back()" class="btn btn-primary">Back to Orders</button>
</div>
@endsection
