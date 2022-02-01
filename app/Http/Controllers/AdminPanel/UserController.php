<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use DataTables;
use Laracasts\Flash\Flash;
use App\Http\Requests\RegisterRequest;
use Sentinel;
use App\Role;
use App\RoleUser;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.users');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::with('roles')->select('users.*');
        return DataTables::eloquent($users)
        ->addColumn('action',function($user){
            if(Sentinel::getUser()->id != $user->id){
                //GET USER (EDIT,DELETE)
                return '<a href="#edit-'.$user->id.'" 
                        class="btn btn-xs btn-primary" 
                        data-toggle ="modal" 
                        data-target="#user-edit" 
                        onclick="userEdit('.$user->id.')">
                        <i class="glyphicon glyphicon-edit"></i>Edit
                        </a>'
                        .
                        '<a href="#delete-'.$user->id.'"
                        class="btn btn-xs btn-danger"
                        data-toggle = "modal"
                        data-target="#user-delete"
                        onclick="userDelete('.$user->id.')"
                        style="margin-left:5px;"
                        >
                        <i class="glyphicon glyphicon-delete"></i>Delete
                        </a>
                        ';
            }
        })
        ->editColumn('id','{{ $id }}')
        ->addColumn('name',function(User $user){
            return $user->roles->map(function($role){
                
                return $role->name;
            });
        })
        ->make(true);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RegisterRequest $request)
    {
        //Хэрэглэгч нэмэх болон идэвхтэй болгох
        $user = Sentinel::registerAndActivate([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => $request->password,
            'same_password' => $request->same_password
        ]);

        $user = Sentinel::findById($user->id);
        $role = Sentinel::findRoleByName($request->role);
        $role->users()->attach($user); //Хэрэглэгч дээр үүрэг нэмэх

        return response()->json(['success' => 'Амжилттай нэмэгдлээ'],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return response()->json(['user' => $user,'role' => $user->roles[0]],200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $request->validate([
                'email' => 'required|email',
                'first_name' => 'required|max:30',
                'last_name' => 'required|max:30',
                'role' => 'required'
        ]);

        $role_id = Role::where('name',$request->role)->first(); 
        RoleUser::where('user_id',$id)->update(['role_id' => $role_id->id]);
        
        $user = User::where('id',$id)->update([

            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,

        ]);


        return response()->json(['success' => 'Амжилттай засагдлаа'],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy($id);
        return response()->json(['success' => 'Амжилттай устгаллаа'],200);
    }
}
