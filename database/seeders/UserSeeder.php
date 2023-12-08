<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // STATIC
        \App\Models\User::factory(10)->create();

        // DINAMIC
        \App\Models\User::Create([
            "name"=> "Admin Mahpudin",
            "email"=> "pudinmah4@gmail.com",
            "password"=> Hash::make("12345678"),
            "roles"=> "ADMIN",
            "phone"=> "085155288364",
        ]);

    }
}
