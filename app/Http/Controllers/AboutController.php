<?php

namespace App\Http\Controllers;

use Auth;

class AboutController extends Controller
{

    public function index()
    {
        if(Auth::check()) {
            return view('pages.om_oss', array('currentUser' => Auth::user()));
        }

        return view('pages.om_oss');
    }

}