<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Show user owned projects
     */
    public function index(Request $request)
    {
        $projects = $request->user()
            ->projects()
            ->latest()
            ->get();

        return view('projects.index-modern', compact('projects'));
    }

    /**
     * Show form create project.
     */
    public function create(Request $request)
    {
        return view('projects.create');
    }

    /**
     * Save new project
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
        ]);

        $request->user()->projects()->create($validated);

        return redirect()
            ->route('app.projects.index')
            ->with('status', 'Project created successfully.');
    }
}
