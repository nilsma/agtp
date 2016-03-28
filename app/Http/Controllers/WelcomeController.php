<?php

namespace App\Http\Controllers;

use Auth;
use App\Posts;

class WelcomeController extends Controller
{

    public function index() {

        $posts = Posts::with('comments')->where('active',1)->orderBy('created_at','desc')->paginate(5);

        if(Auth::check()) {
            return view('pages.velkommen', array('currentUser' => Auth::user()))->with('posts', $posts);
        }

        return view('pages.velkommen')->with('posts', $posts);

    }

}