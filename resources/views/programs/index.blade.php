
@extends('layout')

@section('content')
<div class="container mt-4">
    <h1>Programs</h1>

    <!-- Success Message -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Create Program Button -->
    <a href="{{ route('programs.create') }}" class="btn btn-primary mb-4">Create Program</a>

    <!-- Programs List -->
    <div class="row">
        @foreach($programs as $program)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $program->name }}</h5>
                        <p class="card-text">Points: {{ $program->points }}</p>
                        <p class="card-text">Start Date: {{ $program->start_date }}</p>
                        <p class="card-text">End Date: {{ $program->end_date }}</p>
                        <a href="{{ route('programs.edit', $program->id) }}" class="btn btn-secondary">Edit</a>
                        <form action="{{ route('programs.destroy', $program->id) }}" method="POST" style="display:inline;">
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
