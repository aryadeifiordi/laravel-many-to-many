@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Project Details</div>
                    <div class="card-body">
                        <p><strong>Name:</strong> {{ $project->name }}</p>
                        <p><strong>Description:</strong> {{ $project->description }}</p>
                        <p><strong>Type:</strong> {{ $project->type->name ?? 'No type associated' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
