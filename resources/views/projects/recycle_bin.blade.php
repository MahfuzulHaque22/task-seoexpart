<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recycle Bin</title>
    <style>
        /* Basic styling for table */
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 20px;
        }
        h1 {
            color: #333;
            text-align: center;
        }
        .alert-success {
            color: green;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid green;
            background-color: #f0fff0;
            max-width: 500px;
            margin: 0 auto;
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            overflow: hidden;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #4CAF50;
            color: white;
            font-weight: bold;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .restore-button {
            display: flex;
            justify-content: center;
            margin-top: 15px;
        }
        .restore-button button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1em;
            transition: background-color 0.3s;
        }
        .restore-button button:hover {
            background-color: #45a049;
        }
        .back-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            padding: 10px;
            color: #555;
            text-decoration: none;
            font-size: 1em;
            transition: color 0.3s;
        }
        .back-link:hover {
            color: #333;
        }
    </style>
</head>
<body>
    <h1>Recycle Bin</h1>

    <!-- Success message -->
    @if(session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Recycled Projects Form -->
    <form action="{{ route('projects.restoreMultiple') }}" method="POST">
        @csrf
        <div class="restore-button">
            <button type="submit">Restore Selected Projects</button>
        </div>

        <!-- Recycled Projects Table -->
        <table border="1">
            <thead>
                <tr>
                    <th>Select</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Staff</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($deletedProjects as $project)
                    <tr>
                        <td>
                            <input type="checkbox" name="project_ids[]" value="{{ $project->id }}">
                        </td>
                        <td>{{ $project->name }}</td>
                        <td>{{ $project->description }}</td>
                        <td>{{ $project->staff->name ?? 'N/A' }}</td>
                        <td>
                            <span style="color: red;">Deleted</span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">No deleted projects found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </form>

    <a href="{{ route('projects.index') }}" class="back-link">Back to Projects</a>
</body>
</html>
