
@extends('layout')

@section('content')
<div class="container mt-4">
    <h1>My Orders</h1>

    <!-- Orders List -->
    <div class="row">
        @foreach($orders as $order)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Order #{{ $order->id }}</h5>
                        <p class="card-text">Status: {{ $order->status }}</p>
                        <p class="card-text">Total: ${{ $order->total }}</p>
                        <p class="card-text">Created At: {{ $order->created_at }}</p>
                        <a href="{{ route('orders.show', $order->id) }}" class="btn btn-primary">View Details</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
