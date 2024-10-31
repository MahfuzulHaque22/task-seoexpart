<?php
namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Models\Staff;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::with('staff')->get(); // Eager load the staff relationship
        return view('projects.index', compact('projects'));
    }

    public function show($id)
{
    $project = Project::findOrFail($id); // Fetch the project by ID
    return view('projects.show', compact('project')); // Return a view to display the project details
}
    
    public function create()
    {
        $staffMembers = Staff::all(); // Fetch all staff members
        return view('projects.create', compact('staffMembers'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'staff_id' => 'required|exists:staff,id',
            'file_path' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'status' => 'required|in:active,inactive,hold',
        ]);
    
        // Handle file upload if present
        $filePath = null; // Initialize file path variable
        if ($request->hasFile('file_path')) {
            $filePath = $request->file('file_path')->store('uploads', 'public'); // Store the file
        }
    
        // Create the project and save the file path
        Project::create([
            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
            'staff_id' => $validatedData['staff_id'],
            'file_path' => $filePath,
            'status' => $validatedData['status'],
        ]);
    
        return redirect()->route('projects.index')->with('success', 'Project created successfully.');
    }
    
    public function restore(Request $request)
    {
        $projectIds = $request->input('project_ids'); // Get the array of project IDs
        if ($projectIds) {
            Project::withTrashed()->whereIn('id', $projectIds)->restore();
            return redirect()->route('projects.recycleBin')->with('success', 'Selected projects have been restored.');
        }
        return redirect()->route('projects.recycleBin')->with('error', 'No project selected for restoration.');
    }
    
    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('projects.index')->with('success', 'Project deleted successfully.');
    }
    
    


    public function edit($id)
    {
        $project = Project::findOrFail($id); // Fetch the project by ID
        $staffMembers = Staff::all(); // Fetch all staff members for the dropdown
        return view('projects.edit', compact('project', 'staffMembers')); // Return the edit view
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'staff_id' => 'required|exists:staff,id',
            'file_path' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'status' => 'required|in:active,inactive,hold',
        ]);

        $project = Project::findOrFail($id); // Fetch the project by ID

        // Update project fields
        $project->name = $request->name;
        $project->description = $request->description;
        $project->staff_id = $request->staff_id;
        
        // Handle file upload if a new file is provided
        if ($request->hasFile('file_path')) {
            $filePath = $request->file('file_path')->store('uploads', 'public'); // Save file
            $project->file_path = $filePath; // Update the file path
        }

        $project->status = $request->status;
        $project->save(); // Save the project

        return redirect()->route('projects.index')->with('success', 'Project updated successfully!');
    }
    public function recycleBin()
    {
        // Retrieve the soft-deleted projects
        $deletedProjects = Project::onlyTrashed()->with('staff')->get(); // Eager load the staff relationship
    
        // Pass the deleted projects to the view
        return view('projects.recycle_bin', compact('deletedProjects'));
    }

    public function restoreMultiple(Request $request)
    {
        // Log the incoming request to check if project_ids are present
        \Log::info('Restoring projects', $request->all());
    
        // Retrieve the selected project IDs
        $projectIds = $request->input('project_ids', []);
    
        if (!empty($projectIds)) {
            // Restore the selected projects
            Project::onlyTrashed()->whereIn('id', $projectIds)->restore();
            return redirect()->route('projects.recycleBin')->with('success', 'Selected projects restored successfully.');
        }
    
        // Return error if no projects were selected
        return redirect()->route('projects.recycleBin')->with('error', 'No projects selected for restoration.');
    }
    
    

    



}
