<!-- resources/views/projects/show.blade.php -->
@extends('layouts.app')

@section('content')
    <h1>{{ $project->name }}</h1>
    <p>{{ $project->description }}</p>
    <p>Status: {{ $project->status }}</p>
    <p>Assigned to: {{ $project->staff->name ?? 'N/A' }}</p> <!-- Assuming a relationship with staff -->
    <a href="{{ route('projects.index') }}">Back to Projects</a>
@endsection
