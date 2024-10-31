@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Project</h1>
    
    <form action="{{ route('projects.update', $project->id) }}" method="POST" enctype="multipart/form-data" class="form-container">
        @csrf
        @method('PUT')    

        <div class="form-group">
            <label for="name">Project Name</label>
            <input type="text" name="name" class="form-control" value="{{ $project->name }}" required>
        </div>

        <div class="form-group">
            <label for="description">Project Description</label>
            <textarea name="description" class="form-control" required>{{ $project->description }}</textarea>
        </div>

        <div class="form-group">
            <label for="staff_id">Assign to Staff</label>
            <select name="staff_id" class="form-control" required>
                @foreach($staffMembers as $staff)
                    <option value="{{ $staff->id }}" {{ $staff->id == $project->staff_id ? 'selected' : '' }}>
                        {{ $staff->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="file_path">File Upload</label>
            <div id="dropzone" class="dropzone"></div>
            <input type="hidden" name="file_path" id="file_path" value="{{ $project->file_path }}">
        </div>

        <div class="form-group">
            <label for="status">Project Status</label>
            <select name="status" class="form-control" required>
                <option value="active" {{ $project->status == 'active' ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ $project->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                <option value="hold" {{ $project->status == 'hold' ? 'selected' : '' }}>Hold</option>
            </select>
        </div>

        <button type="submit" class="btn-submit">Update Project</button>
        
        <!-- Back to Projects button -->
        <a href="{{ route('projects.index') }}" class="btn-back">Back to Projects</a>
    </form>
</div>

<!-- Include Dropzone CSS and JS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.0/dropzone.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.0/dropzone.min.js"></script>

<style>
    /* Centering and styling */
    .container {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        background-color: #f9f9f9;
        padding: 20px;
    }
    h1 {
        color: #333;
        text-align: center;
        margin-bottom: 20px;
    }
    .form-container {
        width: 100%;
        max-width: 500px;
        background-color: white;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    .form-group label {
        display: block;
        font-weight: bold;
        margin-bottom: 5px;
        color: #555;
    }
    .form-control {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        font-size: 1em;
        box-sizing: border-box; /* Ensures padding doesn’t overflow */
    }
    .dropzone {
        border: 2px dashed #4CAF50;
        padding: 20px;
        border-radius: 5px;
        background-color: #f0fff0;
        margin-bottom: 15px;
    }
    .btn-submit {
        width: 100%;
        padding: 10px;
        background-color: #4CAF50;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 1em;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: background-color 0.3s;
        margin-top: 10px;
    }
    .btn-submit:hover {
        background-color: #45a049;
    }
    .btn-back {
        display: block;
        width: 100%;
        text-align: center;
        padding: 10px;
       
        color: gray;
        text-decoration: none;
        border-radius: 5px;
        margin-top: 15px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: background-color 0.3s;
    }
    .btn-back:hover {
        background-color: #444;
    }
</style>

<script>
    Dropzone.autoDiscover = false;

    const dropzone = new Dropzone("#dropzone", {
        url: "{{ route('projects.upload') }}", // Set the route for file upload
        paramName: "file", // The name of the file input field
        maxFilesize: 2, // Set the max file size in MB
        acceptedFiles: ".jpeg,.jpg,.png,.pdf", // Limit the file types
        addRemoveLinks: true,
        init: function() {
            this.on("success", function(file, response) {
                // Store the file path in the hidden input field
                document.getElementById('file_path').value = response.file_path;
            });
        },
    });
</script>
@endsection
