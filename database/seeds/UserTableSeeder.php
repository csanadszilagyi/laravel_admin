<?php

use Illuminate\Database\Seeder;
use App\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
        		'username' => 'Admin',
        		'email' => 'admin@test.com',
        		'password' => Hash::make('test77'),
        		'remember_token' => str_random(10)
        ]);
        $admin->assignRole('admin');

        $user1 = User::create([
        		'username' => 'User 1',
        		'email' => 'user1@test.com',
        		'password' => Hash::make('test77'),
        		'remember_token' => str_random(10)
        ]);
        $user1->assignRole(['editor', 'user']);

        $user2 = User::create([
        		'username' => 'User 2',
        		'email' => 'user2@test.com',
        		'password' => Hash::make('test77'),
        		'remember_token' => str_random(10)
        ]);
        $user2->assignRole('editor');

        $user3 = User::create([
        		'username' => 'User 3',
        		'email' => 'user3@test.com',
        		'password' => Hash::make('test77'),
        		'remember_token' => str_random(10)
        ]);
        $user3->assignRole('user');
    }
}
