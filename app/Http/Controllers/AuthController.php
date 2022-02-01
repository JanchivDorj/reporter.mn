<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Sentinel;
use App\User;

use Laracasts\Flash\Flash;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Traits\ShareValues;
use Illuminate\Support\Facades\Hash;
use App\Post;
use App\Log;
use App\Category;

class AuthController extends Controller
{
    use ShareValues;
    //Dashboard [ view ]
    function index(){

        $categories = Category::all(); //asdasd
        $posts = [];
        foreach ($categories as $key => $value) {
            $posts[$key]['visit_post'] =  Post::where('post_img',$value->id)->sum('post_count');
            $posts[$key]['total_post'] =  Post::where('post_img',$value->id)->count();
        }
        return view('pages.dashboard-admin',['categories' => $categories,'posts' => $posts]);
    }
    //login [ view ]
    function login(){
        if(Sentinel::check()){
            // return redirect('/dashboard');

            //FIXME @Sunny
            return redirect('/post');
        }
        return view('auth.login');
    }
    //Register [ view ]
    function register(){
        if(Sentinel::check()){
            // return redirect('/dashboard');

            //FIXME @Sunny
            return redirect('/post');
        }
    
        return view('auth.register');//
    }
    //Register [ add ]
    function postRegister(RegisterRequest $register){
        $user = Sentinel::registerAndActivate($register->all());
    
        if($user){
            $user = Sentinel::login($user);
            $user = Sentinel::findById($user->id);
            $role = Sentinel::findRoleByName('editor');
            $role->users()->attach($user);

            flash('Амжилттай бүртгүүллээ')->success();
            //return redirect('/dashboard');
            //FIXME @Sunny
            return redirect('/post');
        }else{
            flash('Амжилтгүй боллоо')->error();
            return redirect('/register');
        }
    }
    //Login [ start login ]
    function postLogin(LoginRequest $login){
      
        if($user = $this->tryAuthenticate($login)){
            $user = Sentinel::findById($user->id);
            Sentinel::login($user);
            $user = Sentinel::getUser();
            //LOGIN LOG FILE
            Log::create([
                'type' => 'login',
                'ip' => $login->ip(),
                'description' =>  'Login: '.$user->first_name,
                'page_name' => $login->path(),
                'user_id' => $user->id
            ]);

            flash('Амжилттай нэвтэрлээ');

            //return redirect('/dashboard');
            
            //FIXME @Sunny
            return redirect('/post');
        }

        return redirect('/login');
    }
    private function tryAuthenticate($login){
        $user = User::where('first_name',$login->user_name)->first();
        if(!is_null($user)){
            if(Hash::check($login->password,$user->password)){
                return $user;
            }
            return null;
        }
        return null;
    }
    // Logout
    function getLogout(){
        Sentinel::logout(null,true);
        return redirect('/login');
    }
}
