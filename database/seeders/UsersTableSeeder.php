<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'Admin Bookstore',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('book123'),
            ]
        ];

        User::insert($users);
    }
}
