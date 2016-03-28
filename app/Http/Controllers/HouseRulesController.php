<?php

namespace App\Http\Controllers;

use Auth;

class HouseRulesController extends Controller
{

    public function index()
    {
        if(Auth::check()) {
            return view('pages.ordensregler', array('currentUser' => Auth::user()));
        }

        return view('pages.ordensregler');
    }

}