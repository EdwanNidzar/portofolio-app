<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Requests\Projects\StoreRequest;
use App\Http\Requests\Projects\UpdateRequest;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('projects.index', [
            'projects' => Project::latest()->paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('projects.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $validated = $request->validated();

        if ($request->hasFile('image')) {
            $filePath = $request->file('image')->store('projects/images', 'public');
            $validated['image'] = $filePath;
        }

        $project = Project::create($validated);

        if ($project) {
            session()->flash('success', 'Project created successfully');
            return redirect()->route('projects.index');
        } else {
            session()->flash('error', 'Failed to create project');
            return back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        $project = Project::findOrFail($project->id);
        return view('projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $project = Project::findOrFail($project->id);
        return view('projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Project $project)
    {
        $project = Project::findOrFail($project->id);

        $validated = $request->validated();

        $project->update($validated);
       

        if ($request->hasFile('image')) {
            // delete image
            Storage::disk('public')->delete($project->image);
            
            $filePath = $request->file('image')->store('projects/images', 'public');
            $validated['image'] = $filePath;
        }

        if ($project) {
            session()->flash('success', 'Project updated successfully');
            return redirect()->route('projects.index');
        } else {
            session()->flash('error', 'Failed to update project');
            return back()->withInput()->route('projects.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project = Project::findOrFail($project->id);

        // delete image
        Storage::disk('public')->delete($project->image);

        if ($project->delete()) {
            session()->flash('success', 'Project deleted successfully');
            return redirect()->route('projects.index');
        } else {
            session()->flash('error', 'Failed to delete project');
            return back()->withInput()->route('projects.index');
        }
    }

    public function porto(){
        return view('welcome', [
            'projects' => Project::latest()->paginate(3),
        ]);
    }
}
