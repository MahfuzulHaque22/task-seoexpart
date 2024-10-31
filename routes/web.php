<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\FileUploadController;


// Route to handle file uploads
Route::post('/file/upload', [FileUploadController::class, 'upload'])->name('file.upload');

Route::resource('projects', ProjectController::class);
Route::get('projects/recycle-bin', [ProjectController::class, 'recycleBin'])->name('projects.recycleBin');
Route::post('projects/restore', [ProjectController::class, 'restore'])->name('projects.restore');


Route::resource('projects', ProjectController::class);

// Add the route for the recycle bin
Route::get('projects/recycle-bin', [ProjectController::class, 'recycleBin'])->name('projects.recycleBin');

// Add the route for restoring projects
Route::post('projects/restore', [ProjectController::class, 'restore'])->name('projects.restore');


Route::resource('projects', ProjectController::class);

// Define a route if you need a separate upload route
Route::post('projects/upload', [ProjectController::class, 'upload'])->name('projects.upload');

Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
Route::get('/projects/create', [ProjectController::class, 'create'])->name('projects.create');
Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store');
Route::post('/projects/file-upload', [ProjectController::class, 'fileUpload'])->name('file.upload'); // Add this line for file upload
Route::delete('/projects/{project}', [ProjectController::class, 'destroy'])->name('projects.destroy');
Route::post('/projects/{id}/restore', [ProjectController::class, 'restore'])->name('projects.restore');
Route::get('/projects/{id}/edit', [ProjectController::class, 'edit'])->name('projects.edit');
Route::put('/projects/{id}', [ProjectController::class, 'update'])->name('projects.update');
Route::resource('projects', ProjectController::class);
Route::post('/file-upload', [FileUploadController::class, 'upload'])->name('file.upload');
Route::resource('projects', ProjectController::class);
// Route for recycle bin
Route::get('/bin', [ProjectController::class, 'recycleBin'])->name('projects.recycleBin');
Route::post('/projects/{id}/restore', [ProjectController::class, 'restore'])->name('projects.restore');
Route::delete('/projects/{project}', [ProjectController::class, 'destroy'])->name('projects.destroy');
Route::post('/projects/restore-multiple', [ProjectController::class, 'restoreMultiple'])->name('projects.restoreMultiple');

Route::get('/', function () {
    return view('welcome');
});
