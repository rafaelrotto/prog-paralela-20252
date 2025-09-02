<?php

namespace Database\Seeders;

use App\Http\Repositories\UserRepository;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'email' => 'admin@admin.com',
            'name' => 'Admin',
            'password' => bcrypt('12345678'),
            'type' => 'admin',
            'status' => 'active'
        ]);
    }
}
