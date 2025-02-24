<?php

namespace Database\Seeders;

use App\Models\Designation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DesignationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Web Department (ID = 1)
        Designation::firstOrCreate(['designation' => 'Web Developer', 'department_id' => 1]);
        Designation::firstOrCreate(['designation' => 'Frontend Developer', 'department_id' => 1]);
        Designation::firstOrCreate(['designation' => 'Backend Developer', 'department_id' => 1]);
        Designation::firstOrCreate(['designation' => 'UI/UX Designer', 'department_id' => 1]);
        Designation::firstOrCreate(['designation' => 'Full Stack Developer', 'department_id' => 1]);

        // IT Management (ID = 2)
        Designation::firstOrCreate(['designation' => 'IT Manager', 'department_id' => 2]);
        Designation::firstOrCreate(['designation' => 'System Administrator', 'department_id' => 2]);
        Designation::firstOrCreate(['designation' => 'Database Administrator', 'department_id' => 2]);
        Designation::firstOrCreate(['designation' => 'Technical Support Specialist', 'department_id' => 2]);
        Designation::firstOrCreate(['designation' => 'IT Analyst', 'department_id' => 2]);

        // Marketing (ID = 3)
        Designation::firstOrCreate(['designation' => 'Marketing Manager', 'department_id' => 3]);
        Designation::firstOrCreate(['designation' => 'SEO Specialist', 'department_id' => 3]);
        Designation::firstOrCreate(['designation' => 'Content Strategist', 'department_id' => 3]);
        Designation::firstOrCreate(['designation' => 'Social Media Manager', 'department_id' => 3]);
        Designation::firstOrCreate(['designation' => 'Brand Manager', 'department_id' => 3]);

        // Networking (ID = 4)
        Designation::firstOrCreate(['designation' => 'Network Engineer', 'department_id' => 4]);
        Designation::firstOrCreate(['designation' => 'Cybersecurity Analyst', 'department_id' => 4]);
        Designation::firstOrCreate(['designation' => 'Cloud Engineer', 'department_id' => 4]);
        Designation::firstOrCreate(['designation' => 'Wireless Network Engineer', 'department_id' => 4]);
        Designation::firstOrCreate(['designation' => 'Data Center Technician', 'department_id' => 4]);
    }
}
