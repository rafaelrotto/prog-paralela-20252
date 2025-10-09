<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'admin',
            'email' => 'admin@mail.com',
            'password' => bcrypt('password'),
            'status' => 'active',
            'type' => 'admin'
        ]);

        Company::create(['name' => 'test']);

        User::create([
            'name' => 'teacher',
            'email' => 'teacher@mail.com',
            'password' => bcrypt('password'),
            'status' => 'active',
            'type' => 'teacher',
            'company_id' => 1
        ]);

        User::create([
            'name' => 'student',
            'email' => 'student@mail.com',
            'password' => bcrypt('password'),
            'status' => 'active',
            'type' => 'student',
            'company_id' => 1
        ]);

        User::create([
            'name' => 'manager',
            'email' => 'manager@mail.com',
            'password' => bcrypt('password'),
            'status' => 'active',
            'type' => 'manager',
            'company_id' => 1
        ]);
    }
}
