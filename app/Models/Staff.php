<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email'];

    // If you want to define the inverse relationship:
    public function projects()
    {
        return $this->hasMany(Project::class, 'staff_id');
    }
}
