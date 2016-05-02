<?php

use Illuminate\Database\Seeder;
use App\User, App\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        Role::create([
            'id' => 1,
            'name' => 'Administrator',
            'description' => 'Full access to create, edit, and update',
        ]);
        Role::create([
            'id' => 2,
            'name' => 'Customer',
            'description' => 'A standard user that can have a licence assigned to them. No administrative features.',
        ]);
        User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin'),
            'role_id' => 1,
        ]);
        User::create([
            'name' => 'User',
            'email' => 'user@user.com',
            'password' => bcrypt('user'),
            'role_id' => 2,
        ]);
    }
}
