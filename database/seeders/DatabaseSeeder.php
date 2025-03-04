<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'lastname' => 'Doe',
            'firstname' => 'John',
            'middlename' => '',
            'company_id_number' => 'BFD-0001',
            'role_name' => 'Admin',
            'email' => 'john@gmail.com',
        ]);

        $this->call(
            [
                DepartmentSeeder::class,
                DesignationSeeder::class,
            ]
        );
    }
}
