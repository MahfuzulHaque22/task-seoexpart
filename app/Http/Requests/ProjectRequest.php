<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Adjust based on your authorization logic
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'staff_id' => 'required|exists:staff,id',
            'status' => 'required|in:active,inactive,hold',
            'file_path' => 'nullable|string', // Modify as per your file upload handling
        ];
    }
}
