<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Management</title>
    <style>
        /* Basic styling for table and alert message */
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        table {
            width: 80%;
            border-collapse: collapse;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin: 15px;
        }
        th, td {
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
            color: #555;
        }
        .alert-success {
            color: green;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid green;
            background-color: #f0fff0;
            border-radius: 5px;
        }
        /* Styling for the buttons */
        .button-container {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-bottom: 15px;
        }
        .action-button {
            padding: 10px 15px;
            background-color: white;
            color: #555;
            border: 1px solid #ccc;
            border-radius: 30px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            cursor: pointer;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s;
        }
        .action-button:hover {
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
        }
        .action-button .icon {
            font-size: 16px;
        }
        /* Icons styling */
        .icon {
            font-size: 1.2em;
            vertical-align: middle;
        }
        /* Action icons */
        .edit-icon {
            color: #1a73e8;
            border: 1px solid #1a73e8;
            border-radius: 50%;
            padding: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            cursor: pointer;
            transition: all 0.3s;
        }
        .edit-icon:hover {
            background-color: #1a73e8;
            color: white;
        }
        .delete-icon {
            color: #ea4335;
            border: 1px solid #ea4335;
            border-radius: 50%;
            padding: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            cursor: pointer;
            transition: all 0.3s;
        }
        .delete-icon:hover {
            background-color: #ea4335;
            color: white;
        }
    </style>
</head>
<body>
    <h1>Projects</h1>

    <!-- Success message -->
    @if(session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Button container -->
    <div class="button-container">
        <a href="{{ route('projects.create') }}" class="action-button">
            <span class="icon">+</span> Create New Project
        </a>
        <a href="{{ route('projects.recycleBin') }}" class="action-button">
            <span class="icon">🗑️</span> Recycle Bin
        </a>
    </div>

    <!-- Projects Table -->
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Staff</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($projects as $project)
                <tr>
                    <td>{{ $project->name }}</td>
                    <td>{{ $project->description }}</td>
                    <td>{{ $project->staff->name ?? 'N/A' }}</td>
                    <td>
                        <span style="color:
                            {{ $project->status === 'active' ? 'green' : ($project->status === 'inactive' ? 'red' : 'orange') }};">
                            {{ ucfirst($project->status) }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('projects.edit', $project) }}" class="edit-icon" style="text-decoration:none">✏️</a>
                        <form action="{{ route('projects.destroy', $project) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Are you sure you want to delete this project?')" class="delete-icon">🗑️</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
