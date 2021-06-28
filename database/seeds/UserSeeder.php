<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin')
        ]);
        User::create([
            'name' => 'Lucas',
            'email' => 'lucas@admin.com',
            'password' => bcrypt('admin')
        ]);
    }
}
