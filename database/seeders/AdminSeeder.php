<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = new User();
        $user->username = "admin";
        $user->password = Hash::make("admin");
        $user->visible_password = "admin";
        $user->role_id = 0;
        $user->name = "Admin";
        $user->email = "admin@admin.com";
        $user->mobile = "0000000000";
        $user->gender = "Male";
        $user->city = "Surat";
        $user->country = "India";
        $user->save();
    }
}
