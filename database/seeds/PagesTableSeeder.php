<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;

class PagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $admin = DB::table('roles')->where('name','admin')->first();
       $editor = DB::table('roles')->where('name','editor')->first();
        //Pages
        DB::table('pages')->insert(
            [
                [
                    'url' => 'user',
                    'display_name' => 'Users', 
                    'role_id' => $admin->id,
                    'child_item' => 2,
                    'order' => 2,
                    'active' => 1,
                    'icon' => ''
                ],
                [
                    'url' => 'slide-show',
                    'display_name' => 'Slide Show', 
                    'role_id' => $admin->id,
                    'child_item' => 0,
                    'order' => 5,
                    'active' => 1,
                    'icon' => 'mdi-view-carousel'
                ],
                [
                    'url' => 'post',
                    'display_name' => 'Post', 
                    'role_id' => $editor->id,
                    'child_item' => 0,
                    'order' => 2,
                    'active' => 1,
                    'icon' => 'mdi-content-paste'
                ],
                [
                    'url' => 'dashboard',
                    'display_name' => 'Dashboard', 
                    'role_id' => $editor->id,
                    'child_item' => 0,
                    'order' => 1,
                    'active' => 1,
                    'icon' => 'mdi-view-dashboard'
                ],
                [
                    'url' => 'dashboard',
                    'display_name' => 'Dashboard', 
                    'role_id' => $admin->id,
                    'child_item' => 0,
                    'order' => 1,
                    'active' => 1,
                    'icon' => 'mdi-view-dashboard'
                ],
                [
                    'url' => 'post',
                    'display_name' => 'Post', 
                    'role_id' => $admin->id,
                    'child_item' => 0,
                    'order' => 6,
                    'active' => 1,
                    'icon' => 'mdi-content-paste'
                ],
                [
                    'url' => 'permission',
                    'display_name' => 'Permission', 
                    'role_id' => $admin->id,
                    'child_item' => 1,
                    'order' => 3,
                    'active' => 1,
                    'icon' => ''
                ],
                [
                    'url' => 'users',
                    'display_name' => 'Users', 
                    'role_id' => $admin->id,
                    'child_item' => 1,
                    'order' => 4,
                    'active' => 1,
                    'icon' => ''
                ],
                [
                    'url' => 'ajax-permission-active',
                    'display_name' => 'Ajax', 
                    'role_id' => $admin->id,
                    'child_item' => 3,
                    'order' => 0,
                    'active' => 1,
                    'icon' => ''
                ],
                [
                    'url' => 'settings',
                    'display_name' => 'Settings', 
                    'role_id' => $admin->id,
                    'child_item' => 0,
                    'order' => 7,
                    'active' => 1,
                    'icon' => 'mdi-settings'           
                ],
                [
                    'url' => 'ajax-social-media',
                    'display_name' => 'Ajax', 
                    'role_id' => $admin->id,
                    'child_item' => 3,
                    'order' => 1,
                    'active' => 1,
                    'icon' => ''           
                ],
                [
                    'url' => 'ajax-footer-information',
                    'display_name' => 'Ajax', 
                    'role_id' => $admin->id,
                    'child_item' => 3,
                    'order' => 1,
                    'active' => 1,
                    'icon' => ''         
                ],
                [
                    'url' => 'slide-show',
                    'display_name' => 'Slide Show', 
                    'role_id' => $editor->id,
                    'child_item' => 0,
                    'order' => 5,
                    'active' => 1,
                    'icon' => 'mdi-view-carousel'           
                ],
                [
                    'url' => 'logout',
                    'display_name' => 'Logout', 
                    'role_id' => $admin->id,
                    'child_item' => 3,
                    'order' => 1,
                    'active' => 1,
                    'icon' => ''            
                ],
                [
                    'url' => 'logout',
                    'display_name' => 'Logout', 
                    'role_id' => $editor->id,
                    'child_item' => 3,
                    'order' => 1,
                    'active' => 1,
                    'icon' => ''            
                ],
                [
                    'url' => 'img-store-edit',
                    'display_name' => 'storeEdit', 
                    'role_id' => $admin->id,
                    'child_item' => 3,
                    'order' => 1,
                    'active' => 1,
                    'icon' => ''            
                ],
                [
                    'url' => 'ajax-profile',
                    'display_name' => 'Profile', 
                    'role_id' => $admin->id,
                    'child_item' => 3,
                    'order' => 1,
                    'active' => 1,
                    'icon' => ''            
                ],
                [
                    'url' => 'ajax-profile',
                    'display_name' => 'Profile', 
                    'role_id' => $editor->id,
                    'child_item' => 3,
                    'order' => 1,
                    'active' => 1,
                    'icon' => ''            
                ],
                [
                    'url' => 'post-edit',
                    'display_name' => 'Post edit', 
                    'role_id' => $admin->id,
                    'child_item' => 3,
                    'order' => 1,
                    'active' => 1,
                    'icon' => ''          
                ],
                [
                    'url' => 'post-add',
                    'display_name' => 'Post add', 
                    'role_id' => $admin->id,
                    'child_item' => 3,
                    'order' => 1,
                    'active' => 1,
                    'icon' => ''           
                ],
                [
                    'url' => 'log',
                    'display_name' => 'Log', 
                    'role_id' => $admin->id,
                    'child_item' => 0,
                    'order' => 8,
                    'active' => 1,
                    'icon' => 'mdi-file'      
                ],
                [
                    'url' => 'ajax-log',
                    'display_name' => 'Ajax', 
                    'role_id' => $admin->id,
                    'child_item' => 3,
                    'order' => 1,
                    'active' => 1,
                    'icon' => ''             
                ],
                [
                    'url' => 'banner',
                    'display_name' => 'Banner', 
                    'role_id' => $admin->id,
                    'child_item' => 0,
                    'order' => 9,
                    'active' => 1,
                    'icon' => 'mdi-bandcamp'            
                ]
           ]
        );

        $page = DB::table('pages')->where('url','user')->first();
        DB::table('pages')->where('url','permission')->update(['child_item' => $page->id]);
        DB::table('pages')->where('url','users')->update(['child_item' => $page->id]);
        
    }
}
