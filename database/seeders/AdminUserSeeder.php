<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'firstName' => 'John Clerk',
            'middleName' => 'Montejo',
            'fammilyName' => 'Villarosa',
            'role' => 'admin',
            'avatar' => null, // or null if not needed
            'email' => 'admin@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('3122143DRAKEYboi'), // replace with a secure password
            'remember_token' => \Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
