@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Project Details</div>
                    <div class="card-body">
                        <h3>{{ $project->name }}</h3>
                        <p>{{ $project->description }}</p>
                        <h4>Technologies:</h4>
                        <ul>
                            @foreach ($project->technologies as $technology)
                                <li>{{ $technology->name }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
