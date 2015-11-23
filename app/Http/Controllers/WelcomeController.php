<?php

namespace App\Http\Controllers;

use Auth;

class WelcomeController extends Controller
{

    public function index()
    {
        if(Auth::check()) {
            $username = Auth::user()->name;
            return view('pages.velkommen', ['username' => $username]);
        }

        return view('pages.velkommen');

    }

}