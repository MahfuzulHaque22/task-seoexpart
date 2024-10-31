<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToProjectsTable extends Migration
{
    public function up()
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->string('name'); // Project Name
            $table->text('description'); // Project Description
            $table->foreignId('staff_id')->constrained()->onDelete('cascade'); // Assign Project to Staff
            $table->string('file_path')->nullable(); // File Upload
            $table->enum('status', ['active', 'inactive', 'hold']); // Project Status
        });
    }

    public function down()
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn(['name', 'description', 'staff_id', 'file_path', 'status']);
        });
    }
}
