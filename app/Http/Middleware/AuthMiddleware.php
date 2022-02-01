<?php

namespace App\Http\Middleware;

use Closure;
use Sentinel;
use App\Http\Controllers\Traits\ShareValues;
use App\RoleUser;
use App\Page;
class AuthMiddleware
{
    use ShareValues;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if($user = Sentinel::check()){

            $role = RoleUser::where('user_id',$user->id)->first();
            $role = Sentinel::findRoleById($role->role_id);

            $route_name = explode('/',$request->path())[0];
            $page = Page::where('url',$route_name)->first();

            if($role->name == 'admin'){
                
                if($page->active != 0){
                    //GLOBAL VARAIBLE
                    $this->adminShareValue();
                    view()->share('breadcrumb',$page->display_name);
                    return $next($request);
                }else{
                    return redirect('/dashboard');
                }
            }else if($role->name == 'editor'){
                    $this->adminShareValue();
                    view()->share('breadcrumb',$page->display_name);
                if($page->active != 0){
                    return $next($request);
                }else{
                    return redirect('/dashboard');
                }
            }
        }else{
            return redirect('/login');
        }
    }
}
