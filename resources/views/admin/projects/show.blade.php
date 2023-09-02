@extends('layouts.app')

@section('title', $project->title)

@section('content')

    <section id="project-show" class="shadow-lg">
        <div class="container-fluid">
            <h1 class="ps-3 fw-bold pb-0">{{ $project->title }}</h1>
            <div class="line-primary my-4"></div>
            <div class="row pb-1">
                <div class="col-7 align-middle">
                    <img id="show-img" src="{{ $project->image }}" alt="Project Image">
                </div>
                <div class="col-5 d-flex flex-column justify-content-between">
                    <p class="pb-0">{{ $project->description }}</p>
                    <p class="pb-0"><strong>URL:</strong> <a id="project-url"
                            href="{{ $project->url }}">{{ $project->url }}</a></p>
                </div>
            </div>

            <div class="row pt-5">
                <div class="col-7 d-flex">
                    <div class="me-5 ps-3">
                        <p><strong>Completion Year:</strong> {{ $project->completion_year }}</p>
                        <p><strong>Technologies:</strong> {{ $project->technologies }}</p>
                    </div>
                    <div>
                        <p><strong>Client:</strong> {{ $project->client }}</p>
                        <p><strong>Project Duration:</strong> {{ $project->project_duration }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection
