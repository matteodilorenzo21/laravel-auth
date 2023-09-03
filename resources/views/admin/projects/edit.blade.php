@extends('layouts.app')

@section('title', 'Create a new Project')

@section('content')

    @include('components.forms.error-alert')

    <section id="project-create" class="p-0">
        <div class="container">
            <div class="d-flex justify-content-between">
                <h2>Edit | {{ $project->title }}</h2>
            </div>
            <form action="{{ route('admin.projects.update', $project) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row fw-bold">
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="title" class="form-label @error('title') is-invalid @enderror">Titolo</label>
                            <input type="text" class="form-control border border-secondary" id="title" name="title"
                                value="{{ old('title', $project->title) }}">
                        </div>
                        <div class="mb-3">
                            <label for="description"
                                class="form-label @error('description') is-invalid @enderror">Descrizione</label>
                            <textarea rows="2" class="form-control border border-secondary" id="description" name="description">{{ old('description', $project->description) }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Immagine</label>
                            <input type="file"
                                class="form-control border border-secondary @error('image') is-invalid @enderror"
                                id="image" name="image" oninput="updatePreviewImage()"
                                value="{{ old('image', $project->image) }}" accept="image/*">
                        </div>
                        <div>
                            <img class="border border-secondary"
                                src="{{ asset('public/images/' . (old('image', $project->image) ?? 'https://i1.wp.com/potafiori.com/wp-content/uploads/2020/04/placeholder.png?ssl=1')) }}"
                                alt="preview" id="image-preview">
                            <input type="text" class="form-control mt-2" id="image-file-name" readonly
                                value="{{ basename($project->image) }}">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="url" class="form-label">URL</label>
                            <input type="url" class="form-control border border-secondary" id="url" name="url"
                                value="{{ old('url', $project->url) }}">
                        </div>
                        <div class="mb-4">
                            <label for="slug" class="form-label">Slug</label>
                            <input type="text" class="form-control border border-secondary" id="slug"
                                value="{{ Str::slug(old('title', $project->title), '-') }}" disabled>
                        </div>
                        <div class="mb-4">
                            <label for="completion_year" class="form-label">Anno di Completamento</label>
                            <input type="text" class="form-control border border-secondary" id="completion_year"
                                name="completion_year" value="{{ old('completion_year', $project->completion_year) }}">
                        </div>
                        <div class="mb-3">
                            <label for="technologies" class="form-label">Tecnologie Utilizzate</label>
                            <input type="text" class="form-control border border-secondary" id="technologies"
                                name="technologies" value="{{ old('technologies', $project->technologies) }}">
                        </div>
                        <div class="mb-4">
                            <label for="client" class="form-label">Cliente</label>
                            <input type="text" class="form-control border border-secondary" id="client" name="client"
                                value="{{ old('client', $project->client) }}">
                        </div>
                        <div class="mb-3">
                            <label for="project_duration" class="form-label">Durata del Progetto</label>
                            <input type="text" class="form-control border border-secondary" id="project_duration"
                                name="project_duration" value="{{ old('project_duration', $project->project_duration) }}">
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <a href="{{ route('admin.projects.index') }}" class="btn btn-danger">Back<i
                            class="bi bi-arrow-counterclockwise"></i></a>
                    <button type="reset" class="btn btn-secondary mx-2">Reset<i class="bi bi-arrow-repeat"></i></button>
                    <button type="submit" class="btn btn-success">Update<i class="bi bi-check-lg"></i></button>
                </div>
            </form>
        </div>
    </section>

    <script>
        const placeholder = "https://i1.wp.com/potafiori.com/wp-content/uploads/2020/04/placeholder.png?ssl=1";
        const imageInput = document.getElementById("image");
        const previewImage = document.getElementById("image-preview");

        // Dynamic preview image update
        function updatePreviewImage() {
            if (imageInput.files.length > 0) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                };

                reader.readAsDataURL(imageInput.files[0]);
            } else {
                previewImage.src = placeholder;
            }
        }

        const titleInput = document.getElementById("title");
        const slugInput = document.getElementById("slug");

        // Dynamic slug based on title input
        function updateSlug() {
            const titleValue = titleInput.value.trim();
            const slugValue = titleValue.toLowerCase().replace(/[^a-zA-Z0-9]+/g, "-");
            slugInput.value = slugValue;
        }

        // Title event listener
        titleInput.addEventListener("input", updateSlug);
    </script>

@endsection
