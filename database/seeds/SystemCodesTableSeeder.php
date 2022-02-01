<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SystemCodesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('system_codes')->insert([
            [
                'image' => '/slide_show_img/default.jpg',
                'active'=> 1,
                'system_name' => 'slide_show'
            ],
            [
                'image' => '/slide_show_img/default.jpg',
                'active'=> 0,
                'system_name' => 'slide_show'
            ],
            [
                'image' => '/slide_show_img/default.jpg',
                'active'=> 0,
                'system_name' => 'slide_show'
            ],
            [
                'image' => '/slide_show_img/default.jpg',
                'active'=> 0,
                'system_name' => 'slide_show'
            ],
            [
                'image' => 'default',
                'active'=> 1,
                'system_name' => 'media',
            ],
            [
                'image' => 'default',
                'active'=> 1,
                'system_name' => 'media',
            ],
            [
                'image' => 'default',
                'active'=> 1,
                'system_name' => 'media',
            ],
            [
                'image' => 'default',
                'active'=> 1,
                'system_name' => 'address',
            ],
            [
                'image' => 'default', 
                'active'=> 1,
                'system_name' => 'mail',
            ],
            [
                'image' => 'default', 
                'active'=> 1,
                'system_name' => 'send_email',
            ]
        ]);
    }
}
