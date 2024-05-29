@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit Project</div>
                    <div class="card-body">
                        <form action="{{ route('admin.projects.update', $project->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" class="form-control" value="{{ $project->name }}"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea name="description" class="form-control" required>{{ $project->description }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="type_id">Type</label>
                                <select name="type_id" class="form-control" required>
                                    @foreach ($types as $type)
                                        <option value="{{ $type->id }}"
                                            {{ $project->type_id == $type->id ? 'selected' : '' }}>{{ $type->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
