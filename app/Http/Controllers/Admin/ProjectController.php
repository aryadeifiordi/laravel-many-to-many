<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Type;
use App\Models\Technology;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::with('type')->get();
        return view('admin.projects.index', compact('projects'));
    }

    public function create()
    {
        $types = Type::all();
        $technologies = Technology::all();
        return view('admin.projects.create', compact('types', 'technologies'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'type_id' => 'required|exists:types,id',
            'technologies' => 'array|exists:technologies,id',
        ]);

        $project = new Project;
        $project->name = $validatedData['name'];
        $project->description = $validatedData['description'];
        $project->type_id = $validatedData['type_id'];
        $project->save();

        if (isset($validatedData['technologies'])) {
            $project->technologies()->attach($validatedData['technologies']);
        }

        return redirect()->route('admin.projects.index');
    }

    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    public function edit(Project $project)
    {
        $types = Type::all();
        $technologies = Technology::all();
        return view('admin.projects.edit', compact('project', 'types', 'technologies'));
    }

    public function update(Request $request, Project $project)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'type_id' => 'required|exists:types,id',
            'technologies' => 'array|exists:technologies,id',
        ]);

        $project->name = 
