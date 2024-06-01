@extends('layouts.admin')

@section('content')
    <h1>Edit Project</h1>

    <form action="{{ route('admin.projects.update', $project->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label for="name">Project Name:</label>
            <input type="text" id="name" name="name" value="{{ $project->name }}" required>
        </div>


        <div>
            <label for="description">Description:</label>
            <textarea id="description" name="description" required>{{ $project->description }}</textarea>
        </div>


        <div>
            <label for="type_id">Type:</label>
            <select id="type_id" name="type_id" required>
                @foreach ($types as $type)
                    <option value="{{ $type->id }}" @if ($type->id == $project->type_id) selected @endif>
                        {{ $type->name }}</option>
                @endforeach
            </select>
        </div>


        <div>
            <label for="technologies">Technologies:</label>
            <select id="technologies" name="technologies[]" multiple>
                @foreach ($technologies as $technology)
                    <option value="{{ $technology->id }}" @if ($project->technologies->contains($technology->id)) selected @endif>
                        {{ $technology->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit">Update</button>
    </form>
@endsection
