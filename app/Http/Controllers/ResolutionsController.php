<?php

namespace App\Http\Controllers;

use Auth;

class ResolutionsController extends Controller
{

    public function index()
    {
        if(Auth::check()) {
            $username = Auth::user()->name;
            return view('pages.vedtekter', ['username' => $username]);
        }

        return view('pages.vedtekter');
    }

}