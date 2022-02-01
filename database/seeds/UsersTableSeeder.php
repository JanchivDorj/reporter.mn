<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = [
            'first_name' => 'admin',
            'last_name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => 'abc123'
        ];

 
        $user = Sentinel::registerAndActivate($admin);
        //$user = Sentinel::login($user);
        $user = Sentinel::findById($user->id);
        $role = Sentinel::findRoleByName('admin');
        $role->users()->attach($user); 
    }
}
