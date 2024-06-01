@extends('layouts.admin')

@section('content')
    <h1>Create Project</h1>

    <form action="{{ route('admin.projects.store') }}" method="POST">
        @csrf

        <div>
            <label for="name">Project Name:</label>
            <input type="text" id="name" name="name" required>
        </div>


        <div>
            <label for="description">Description:</label>
            <textarea id="description" name="description" required></textarea>
        </div>


        <div>
            <label for="type_id">Type:</label>
            <select id="type_id" name="type_id" required>
                @foreach ($types as $type)
                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                @endforeach
            </select>
        </div>


        <div>
            <label for="technologies">Technologies:</label>
            <select id="technologies" name="technologies[]" multiple>
                @foreach ($technologies as $technology)
                    <option value="{{ $technology->id }}">{{ $technology->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit">Create</button>
    </form>
@endsection
