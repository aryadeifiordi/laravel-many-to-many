@extends('layouts.app')
@section('content')
    <div class="container mt-5">
        <a href="{{ route('admin.projects.index') }}" class="btn btn-success my-4">
            Torna alla lista Progetti
        </a>

        <h1 class="my-4">Crea il tuo Progetto</h1>


        @if ($errors->any())
            <div class="alert alert-danger">
                <h3>Correggi i seguenti errori</h3>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('admin.projects.store') }}" method="POST" class="row g-3" enctype="multipart/form-data">
            @csrf <!-- Aggiunto il token CSRF -->

            <div class="col-3">
                <label for="title">Title</label>
                <input type="text" name="title" id="title"
                    class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}">
                @error('title')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-3">
                <label for="name">Nome del file</label>
                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                    value="{{ old('name') }}">
                @error('name')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                @enderror
            </div>



            <div class="col-3">
                <label for="slug">Slug</label>
                <input type="text" name="slug" id="slug" class="form-control @error('slug') is-invalid @enderror"
                    value="{{ old('slug') }}">
                @error('slug')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                @enderror
            </div>


            <div class="col-3">
                <label for="type_id">Tipologia</label>
                <select name="type_id" id="type_id" class="form-select">
                    <option value="">Seleziona una tipologia</option>
                    @foreach ($types as $type)
                        <option value="{{ $type->id }}">
                            {{ $type->label }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="row">
                <div class="col-3">
                    <label for="image">Immagine</label>
                    <input type="file" name="image" id="image"
                        class="form-control @error('image') is-invalid @enderror" value="{{ old('image') }}">
                    @error('image')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-4 mt-2">
                    <img src="" class="img-fluid" id="image_preview">

                </div>
            </div>






            <div class="col-12">
                <div class="row">
                    <label for="technologies">Tecnologie</label>
                    @foreach ($technologies as $technology)
                        <div class="col-2">
                            <input type="checkbox" name="technologies[]" id="technology_{{ $technology->id }}"
                                value="{{ $technology->id }}" class="form-check-input">
                            <label for="technology_{{ $technology->id }}" class="form-check-control">
                                {{ $technology->label }}
                            </label>
                        </div>
                    @endforeach
                </div>

            </div>




            <div class="col-12">
                <label for="content">Content</label>
                <textarea name="content" id="content" class="form-control @error('content') is-invalid @enderror" rows="4">{{ old('content') }}</textarea>
                @error('content')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-12">
                <button type="submit" class="btn btn-primary">Inserisci Progetto</button>
            </div>
        </form>


    </div>
    </div>
@endsection


@section('scripts')
    <script type="text/javascript">
        const inputFileElement = document.getElementById('image');
        const imagePreview = document.getElementById('image_preview');

        if (!imagePreview.getAttribute('src')) {
            imagePreview.src = "https://placehold.co/400";
        }

        inputFileElement.addEventListener('change', function() {
            const [file] = this.files;
            imagePreview.src = URL.createObjectURL(file)
        })
    </script>
@endsection
