<?php

namespace App\Http\Middleware;

use Closure;
use App\SystemCode;
class VisitMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $footer_information = SystemCode::whereIn('system_name',['address','mail'])->get();
        $social_media = SystemCode::whereIn('system_name',['media'])->get();
        
        view()->share('footer_information',$footer_information);
        view()->share('social_media',$social_media);

        return $next($request);
    }
}
