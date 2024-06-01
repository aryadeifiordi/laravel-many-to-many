@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ $project->name }}</div>

                    <div class="card-body">
                        <p>Description: {{ $project->description }}</p>
                        <p>Type: {{ $project->type->name }}</p>

                        <p>Technologies:</p>
                        <ul>
                            @forelse ($project->technologies as $technology)
                                <li>{{ $technology->name }}</li>
                            @empty
                                <li>No technologies associated</li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
