<?php

namespace Login\Http\Controllers;

use Illuminate\Http\Request;
use Login\User;
use Session;
use Redirect;

class PerfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $users=User::orderBY('id','desc')->paginate(4);
        return view('home', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users=User::orderBY('id','desc')->paginate(4);
        return view('home', compact('users'));
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
    public function edit(Request $request, $id)
    {
        $request->user()->authorizeRoles(['user', 'admin']);

        if ($request->user()->id!=$id) {
            $users=User::orderBY('id','desc')->paginate(4);
            return view('home', compact('users'));
        }else{
            $user = User::find($id);
            return view('perfile.index', compact('user'));
        }
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
        $this->validate($request, [
            'name'      => 'required|string|max:255',
            'email'     => 'required|email|unique:users,email,'.$id,
            'profile'   => 'image|nullable|max:1999',
            'password'  => 'nullable|min:6',
        ]);
        $password= "";
        $newname = "";
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


        Session::flash('success','Perfil Actualizado Exitosamente');
        return Redirect::to('home'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
