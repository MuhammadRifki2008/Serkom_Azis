<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'username' => 'admin',
                'password' => bcrypt('Admin12345'),
                'role' => 'Admin',
            ],
            [
                'username' => 'operator',
                'password' => bcrypt('Operator12345'),
                'role' => 'Operator',
            ],
        ];

        foreach ($users as $user) {
            $exists = DB::table('users')
                ->where('username', $user['username'])
                ->exists();

            if (!$exists) {
                DB::table('users')->insert($user);
            }
        }
    }
}
