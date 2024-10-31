<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileUploadController extends Controller
{
    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048', // Validate the file
        ]);

        if ($request->hasFile('file')) {
            // Store the file and get its path
            $filePath = $request->file('file')->store('uploads', 'public');

            return response()->json(['filePath' => $filePath]); // Return the file path in response
        }

        return response()->json(['error' => 'File not uploaded'], 400);
    }
}
