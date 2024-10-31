<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StaffSeeder extends Seeder
{
    public function run()
    {
        // Clear the staff table to prevent duplicates
        DB::table('staff')->truncate(); // Note: Truncate removes all records
    
        // Insert new records
        DB::table('staff')->insert([
            ['name' => 'Md Mizanur Rahman', 'email' => 'mizanurrahman@seoexpart.com'],
            ['name' => 'Razia Sultana', 'email' => 'raziasultana@seoexpart.com'],
            ['name' => 'shajahanali', 'email' => 'shajahan@seoexpart.com'],
        ]);
    }
    
}
