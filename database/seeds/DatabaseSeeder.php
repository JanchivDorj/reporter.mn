<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    { 
        $this->call(
            [
                RolesTableSeeder::class,
                UsersTableSeeder::class,
                PagesTableSeeder::class,
                SystemCodesTableSeeder::class,
                GategoriesTableSeeder::class
            ]);
    }
}
