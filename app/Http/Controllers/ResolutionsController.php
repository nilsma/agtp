<?php

namespace App\Http\Controllers;

use Auth;

class ResolutionsController extends Controller
{

    public function index()
    {
        if(Auth::check()) {
            return view('pages.vedtekter', array('currentUser' => Auth::user()));
        }

        return view('pages.vedtekter');
    }

}