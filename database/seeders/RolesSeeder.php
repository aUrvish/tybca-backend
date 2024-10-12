<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::insert([
            [
                'name' => 'Root Admin',
                'description' => 'The Root Admin manages tenant accounts with full CRUD capabilities and oversees the entire billing process, including payment and subscription management.'
            ],
            [
                'name' => 'Admin/Client',
                'description' => 'The Admin/Client manages their assigned tenant account, handling day-to-day tasks and account settings'
            ],
        ]);
    }
}
