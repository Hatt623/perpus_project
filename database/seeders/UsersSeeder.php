<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use DB;
use App\Models\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->delete();

        User::create([
            'name' => 'Admin',
            'email' => 'Admin@gmail.com',
            'password' => bcrypt('rahasia'),
            
            'isAdmin' => 1,
        ]);

        User::create([
            'name' => 'tester',
            'email' => 'tester@gmail.com',
            'password' => bcrypt('rahasia'),

            'isAdmin' => 0,
        ]);
    }
}
