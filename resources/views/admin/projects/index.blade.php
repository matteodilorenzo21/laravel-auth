@extends('layouts.app')

@section('title', 'Projects')

@section('content')

    <section id="projects-index" class="bg-dark">

        <div class="table-actions d-flex justify-content-start align-items-center">
            <h1>Projects</h1>
            <a id="add-project-btn" class="ms-1" href="{{ route('admin.projects.create') }}"><i class="bi bi-plus-lg"></i></a>
        </div>

        <table id="projects-table" class="table table-dark table-striped">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Title</th>
                    <th scope="col">Url</th>
                    <th scope="col">Year</th>
                    <th scope="col">Client</th>
                    <th scope="col">Created at</th>
                    <th scope="col">Last update</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($projects as $project)
                    <tr class="align-middle">
                        <th scope="row">{{ $project->id }}</th>
                        <td>{{ $project->title }}</td>
                        <td>{{ $project->url }}</td>
                        <td>{{ $project->completion_year }}</td>
                        <td>{{ $project->client }}</td>
                        <td>{{ $project->created_at }}</td>
                        <td>{{ $project->updated_at }}</td>
                        <td class="vert">
                            <a href="{{ route('admin.projects.show', $project) }}" id="show-btn"
                                class="project-action d-inline"><i class="bi bi-eye"></i></a>
                            <a href="{{ route('admin.projects.edit', $project) }}" id="edit-btn"
                                class="project-action d-inline ml-2"><i class="bi bi-pen"></i></a>
                            <form class="d-inline" action="{{ route('admin.projects.destroy', $project) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" id="destroy-btn" class="project-action d-inline ml-2"><i
                                        class="bi bi-x-lg"></i></button>
                            </form>
                        </td>

                    </tr>
                @empty
                    <tr>
                        <td class="text-center">
                            <h2>No projects to see here..</h2>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </section>

@endsection
