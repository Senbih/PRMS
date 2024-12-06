<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Abebe Kebede',
                'email' => 'admin@admin.com',
                'password' => bcrypt('admin'),
                'role' => 'admin',

            ],
            [
                'name' => 'John Doe',
                'email' => 'staff@staff.com',
                'password' => bcrypt('staff'),
                'role' => 'staff',

            ],
            [
                'name' => 'Senay Bihon',
                'email' => 'teamleader@teamleader.com',
                'password' => bcrypt('teamleader'),
                'role' => 'teamleader',

            ]
        ]);
    }
}
