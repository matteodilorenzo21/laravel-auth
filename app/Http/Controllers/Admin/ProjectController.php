<?php

namespace App\Http\Controllers\Admin;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::orderBy('updated_at', 'DESC')->get();

        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.projects.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5120',
            'url' => 'nullable|url',
            'slug' => 'string|unique:projects,slug',
            'completion_year' => 'nullable|integer',
            'technologies' => 'nullable|string',
            'client' => 'nullable|string',
            'project_duration' => 'nullable|string',
        ]);

        $project = new Project();

        $project->fill($validatedData);

        if ($request->hasFile('image')) {
            $originalFileName = $request->file('image')->getClientOriginalName();

            $imagePath = $request->file('image')->storeAs('public/images', $originalFileName);
            $project->image = $originalFileName;
        }

        if (!$project->slug) {
            $project->slug = Str::slug($project->title, '-');
        }

        $project->save();

        return redirect()->route('admin.projects.show', $project->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5120',
            'url' => 'nullable|url',
            'slug' => 'string|unique:projects,slug,' . $project->id, // Escludi il record attuale dall'unicità dello slug
            'completion_year' => 'nullable|integer',
            'technologies' => 'nullable|string',
            'client' => 'nullable|string',
            'project_duration' => 'nullable|string',
        ]);

        $data = $request->all();

        // Verifica se è stato caricato un nuovo file immagine
        if ($request->hasFile('image')) {
            $originalFileName = $request->file('image')->getClientOriginalName();

            $imagePath = $request->file('image')->storeAs('public/images', $originalFileName);
            $data['image'] = $originalFileName;
        }

        $project->update($data);

        return redirect()->route('admin.projects.show', $project->id);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('admin.projects.index');
    }
}
