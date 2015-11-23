<?php

namespace App\Http\Controllers;

use Auth;

class HouseRulesController extends Controller
{

    public function index()
    {
        if(Auth::check()) {
            $username = Auth::user()->name;
            return view('pages.ordensregler', ['username' => $username]);
        }

        return view('pages.ordensregler');
    }

}