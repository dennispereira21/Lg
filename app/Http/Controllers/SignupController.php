<?php

namespace Login\Http\Controllers;

use Illuminate\Http\Request;
use Login\User;
use Login\Role;
use Session;
use Redirect;

class SignupController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    
     public function index(Request $request)
    {
        $request->user()->authorizeRoles('admin');
        $users=User::orderBY('id','desc')->paginate(4);
        return view('home', compact('users'));
    }

  
    public function create(Request $request)
    {
        $request->user()->authorizeRoles('admin');
        return view('signup.create');
    }

    
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'      => 'required|string|max:255',
            'email'     => 'required|string|email|max:255|unique:users',
            'password'  => 'required|string|min:6|confirmed',
            'profile'   => 'image|nullable|max:1999',
        ]);


        if ($request->hasFile('profile')) {
            $nameext    = $request->file('profile')->getClientOriginalName();
            $name       = pathinfo($nameext, PATHINFO_FILENAME);
            $ext        = $request->file('profile')->getClientOriginalExtension();
            $newname    = $name.time().'.'.$ext;
            $path       = $request->file('profile')->storeAs('public/profile', $newname);
        }else{
            $newname = 'Avatar.png';
        }

        $user = User::create([
            'name'          => $request['name'],
            'email'         => $request['email'],
            'password'      => bcrypt($request['password']),
            'profile'       => $newname,
        ]);

        $user->roles()->attach(Role::where('name', 'user')->first());

        Session::flash('success','Usuario Registrado Exitosamente');
        return Redirect::to('users');
    }

    
    public function show($id)
    {
        //
    }

    
    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
