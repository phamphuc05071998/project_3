
@extends('layout')

@section('content')
<div class="container mt-4">
    <h1>Edit Program</h1>

    <form action="{{ route('programs.update', $program->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Program Name</label>
            <input type="text" name="name" class="form-control" id="name" value="{{ $program->name }}" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" class="form-control" id="description">{{ $program->description }}</textarea>
        </div>
        <div class="form-group">
            <label for="points">Points</label>
            <input type="number" name="points" class="form-control" id="points" value="{{ $program->points }}" required>
        </div>
        <div class="form-group">
            <label for="start_date">Start Date</label>
            <input type="date" name="start_date" class="form-control" id="start_date" value="{{ $program->start_date }}" required>
        </div>
        <div class="form-group">
            <label for="end_date">End Date</label>
            <input type="date" name="end_date" class="form-control" id="end_date" value="{{ $program->end_date }}" required>
        </div>
        <div class="form-group">
            <label for="products">Select Products</label>
            <select name="products[]" class="form-control" id="products" multiple required>
                @foreach($products as $product)
                    <option value="{{ $product->id }}" {{ in_array($product->id, $program->products->pluck('id')->toArray()) ? 'selected' : '' }}>
                        {{ $product->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update Program</button>
    </form>
</div>
@endsection
