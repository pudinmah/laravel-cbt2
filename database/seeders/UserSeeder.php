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
        \App\Models\User::factory(10)->create();

        \App\Models\User::create([
            'name'=>'Mahpudin',
            'email'=>'mahpudin@gmail.com',
            'password'=>Hash::make('12341234'),
            'roles'=>'ADMIN',
            'phone'=>'085155288634',
        ]);
    }
}
