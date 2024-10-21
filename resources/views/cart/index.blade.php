@extends('layout')

@section('content')
<div class="container mt-4">
    <h1>My Cart</h1>

    <!-- Success Message -->
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <!-- Error Message -->
    @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif

    <!-- Display User Points -->
    <div class="mb-4">
        <h4>Your Points: {{ Auth::user()->points }}</h4>
    </div>

    <!-- Cart Items -->
    <div class="row">
        @foreach($cartItems as $cartItem)
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ $cartItem->product->name }}</h5>
                    <p class="card-text">Price: ${{ $cartItem->product->price }}</p>
                    <p class="card-text">Quantity: {{ $cartItem->quantity }}</p>
                    <form action="{{ route('cart.remove', $cartItem->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Remove</button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Checkout Form -->
    @if($cartItems->isNotEmpty())
    <form action="{{ route('cart.checkout') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="use_points">Use Points for Payment</label>
            <input type="checkbox" name="use_points" id="use_points">
        </div>
        <button type="submit" class="btn btn-success">Checkout</button>
    </form>
    @endif
</div>
@endsection
