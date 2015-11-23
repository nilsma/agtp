<?php

namespace App\Http\Controllers;

use Auth;

class AboutController extends Controller
{

    public function index()
    {
        if(Auth::check()) {
            $username = Auth::user()->name;
            return view('pages.om_oss', ['username' => $username]);
        }

        return view('pages.om_oss');
    }

}