<?php

use Illuminate\Database\Seeder;
use App\Category;
class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Role
        DB::table('categories')->insert(
            [
                [
                    'name' => '&#1041;&#1080;&#1095;&#1083;&#1101;&#1075;',
                    'category_count' => 0
                ],
                [
                    'name' => '&#1050;&#1080;&#1085;&#1086;',
                    'category_count' => 0
                ],
                [
                    'name' => '&#1044;&#1091;&#1091; &#1093;&#1257;&#1075;&#1078;',
                    'category_count' => 0
                ],
                [
                    'name' => '&#1044;&#1088;&#1072;&#1084;&#1072;',
                    'category_count' => 0
                ],
                [
                    'name' => '&#1041;&#1091;&#1089;&#1072;&#1076;',
                    'category_count' => 0
                ]
            ]);
    }
}



