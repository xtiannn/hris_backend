<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Department::firstOrCreate(['department' => 'Web Department']);
        Department::firstOrCreate(['department' => 'IT Management']);
        Department::firstOrCreate(['department' => 'Marketing']);
        Department::firstOrCreate(['department' => 'Networking']);
    }
}
