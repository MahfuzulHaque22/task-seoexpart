<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'description', 'staff_id', 'file_path', 'status'];

    // Define the relationship with the Staff model
    public function staff()
    {
        return $this->belongsTo(Staff::class, 'staff_id'); // 'staff_id' is the foreign key in the projects table
    }
}
