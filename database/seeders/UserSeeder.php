<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'first_name' => 'Admin',
            'last_name' => 'Testing',
            'dob' => '1990-01-01',
            'email' => 'admin@gmail.com',
            // 'password' => 'admin@123', 
            'password' => Hash::make('admin@123'), 
            'role_id' => 1,    // Role: admin
            'gender_id' => 2,  
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
