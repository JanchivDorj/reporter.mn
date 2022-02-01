<?php

namespace App\Http\Controllers\Traits;
use Sentinel;
use App\RoleUser;
use App\Page;
trait ShareValues{
    public function adminShareValue(){
        if(Sentinel::check()){
            $user = Sentinel::getUser();
            $role = RoleUser::where('user_id',$user->id)->first();
            $role = Sentinel::findRoleById($role->role_id);
            //Get menus 
            $pages = Page::where('role_id',$role->id)->whereIn('child_item',array(0,2))->where('active',1)->orderBy('order', 'asc')->get();
            //Get items
            $items = Page::where('role_id',$role->id)->where('child_item','!=',0)->where('active',1)->orderBy('order','asc')->get();
            //share variable
            view()->share('menus',$pages);
            view()->share('items',$items);
            view()->share('first_name',$user->first_name);
            view()->share('role_name',$role->slug);
            view()->share('user_id',$user->id);
        }
    }
}