<?php

namespace App\Http\Controllers;

use Auth;

class AdminController extends Controller
{

    public function index()
    {
        if(Auth::check()) {

            return view('admin.dashboard', ['username' => Auth::user()->name]);

        } else {

            return redirect('/');

        }

    }

}