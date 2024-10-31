<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Project</title>
    <!-- Dropzone CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.css" />
    <style>
        /* General styling */
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            padding: 20px;
            background-color: #f9f9f9;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        form {
            width: 100%;
            max-width: 500px;
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #555;
        }
        input[type="text"],
        textarea,
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            font-size: 1em;
        }
        textarea {
            resize: vertical;
            min-height: 80px;
        }
        button[type="submit"] {
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
        }
        button[type="submit"]:hover {
            background-color: #45a049;
        }
        .dropzone {
            border: 2px dashed #4CAF50;
            padding: 20px;
            border-radius: 5px;
            background-color: #f0fff0;
        }
        /* Styling for the back link */
        a {
            display: inline-block;
            margin-top: 15px;
            text-decoration: none;
            color: #1a73e8;
            font-weight: bold;
            transition: color 0.3s;
        }
        a:hover {
            color: #1558b8;
        }
    </style>
</head>
<body>
    <h1>Create New Project</h1>
    <form action="{{ route('projects.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div>
            <label for="name">Project Name</label>
            <input type="text" id="name" name="name" required>
        </div>
        <div>
            <label for="description">Project Description</label>
            <textarea id="description" name="description" required></textarea>
        </div>
        <div>
            <label for="staff_id">Assign Project to Staff</label>
            <select id="staff_id" name="staff_id" required>
                @foreach($staffMembers as $staff)
                    <option value="{{ $staff->id }}">{{ $staff->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="file">File Upload</label>
            <div id="file-dropzone" class="dropzone"></div>
            <input type="hidden" name="file_path" id="file_path">
        </div>

        <div>
            <label for="status">Project Status</label>
            <select id="status" name="status" required>
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
                <option value="hold">Hold</option>
            </select>
        </div>
        <button type="submit">Create Project</button>
    </form>

    <a href="{{ route('projects.index') }}">Back to Projects</a>

    <!-- Dropzone JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.js"></script>
    <script>
        Dropzone.options.fileDropzone = {
            url: "{{ route('file.upload') }}", // Ensure this route is correct
            maxFiles: 1,
            acceptedFiles: '.png,.jpg,.jpeg,.pdf,.docx',
            success: function (file, response) {
                console.log("Upload Success Response:", response); // Log response for debugging
                document.getElementById('file_path').value = response.filePath; // Set the hidden input to file path
            },
            error: function (file, response) {
                console.log("File upload error:", response); // Log any upload errors
            }
        };
    </script>
</body>
</html>
