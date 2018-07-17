<?php

namespace Login\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Login\User;
use Login\Role;
use Login\RoleUser;
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

        $mail       = $request['email'];
        $username   = User::part($mail);
        $user = User::create([
            'name'          => $request['name'],
            'email'         => $request['email'],
            'username'      => $username[0],
            'password'      => bcrypt($request['password']),
            'profile'       => $newname,
        ]);

        $user->roles()->attach(Role::where('name', 'user')->first());

        Session::flash('success','Usuario Registrado Exitosamente');
        return Redirect::to('users');
    }

    
    public function show(Request $request, $id)
    {
        $request->user()->authorizeRoles('admin');
        $users=User::orderBY('id','desc')->paginate(4);
        return view('home', compact('users'));
    }

    
    public function edit(Request $request, $id)
    {
        $request->user()->authorizeRoles('admin');
        $category = Role::pluck('description','name');
        $category->prepend('Seleccione una opcion','0');
        $user = User::find($id);
        return view('signup.edit', compact('user','category'));
        
    }

    public function update(Request $request, $id)
    {
        
        $this->validate($request, [
            'name'      => 'required|string|max:255',
            'email'     => 'required|email|unique:users,email,'.$id,
            'profile'   => 'image|nullable|max:1999',
            'password'  => 'nullable|min:6',
            'role'      => 'required|string|not_in:0',
        ]);

        $password= "";
        $newname = "";
        // Como actualizar la imagen remplazando a la anterior
        //Falta guardar el rol en la tabla role_user
        $role = Role::where('name', $request['role'])->first();

        if (!empty($request['password'])) {
            
            $password = bcrypt($request['password']); ;
        }

        if ($request->hasFile('profile')) {
            $nameext    = $request->file('profile')->getClientOriginalName();
            $name       = pathinfo($nameext, PATHINFO_FILENAME);
            $ext        = $request->file('profile')->getClientOriginalExtension();
            $newname    = $name.time().'.'.$ext;
            $path       = $request->file('profile')->storeAs('public/profile', $newname);
        }

        if (empty($password) AND empty($newname)) {
            
            User::find($id)->update([
                'name'          => $request['name'],
                'email'         => $request['email'],
            ]);           
            
        }elseif (!empty($password) AND empty($newname) ) {
            User::find($id)->update([
                'name'          => $request['name'],
                'email'         => $request['email'],
                'password'      => $password,
            ]);
        }elseif (empty($password) AND !empty($newname)) {
            User::find($id)->update([
                'name'          => $request['name'],
                'email'         => $request['email'],
                'profile'       => $newname,
            ]);
        }else{
            User::find($id)->update([
                'name'          => $request['name'],
                'email'         => $request['email'],
                'password'      => $password,
                'profile'       => $newname,
            ]);
        }


        Session::flash('success','Usuario Actualizado Exitosamente');
        return Redirect::to('home');

    }

    public function destroy(Request $request, $id)
    {
        $request->user()->authorizeRoles('admin');
        $user = User::find($id);
        if ($user->profile !='Avatar.png') {
            Storage::delete('public/profile/'.$user->profile);
        }
        $user->delete();
        Session::flash('success','Usuario Eliminado Exitosamente');
        return Redirect::to('home');
    }
}
