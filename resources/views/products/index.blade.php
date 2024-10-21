
@extends('layout')

@section('content')
<div class="container mt-4">
    <h1>Products</h1>

    <!-- Success Message -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Create Product Button -->
    <a href="{{ route('products.create') }}" class="btn btn-primary mb-4">Create Product</a>

    <!-- Products List -->
    <div class="row">
        @foreach($products as $product)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text">Price: ${{ $product->price }}</p>
                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-secondary">Edit</a>
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
