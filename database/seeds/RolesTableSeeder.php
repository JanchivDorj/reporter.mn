<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Role
        DB::table('roles')->insert(
        [
            [
            'slug' => 'Admin',
            'name' => 'admin'
            ],
            [
                'slug' => 'Editor',
                'name' => 'editor'
            ]
        ]);
    }
}
