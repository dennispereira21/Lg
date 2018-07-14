<?php

namespace Login\Http\Controllers;

use Illuminate\Http\Request;
use Login\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->user()->authorizeRoles(['user', 'admin']);
        $users=User::orderBY('id','desc')->paginate(4);
        return view('home', compact('users'));
    }

}
