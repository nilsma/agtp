<?php

namespace App\Http\Controllers;

use Auth;
use App\Posts;

class WelcomeController extends Controller
{

    public function index() {

        $posts = Posts::with('comments')->where('active',1)->orderBy('created_at','desc')->paginate(5);

        $title = 'Latest Posts';

        if(Auth::check()) {
            $username = Auth::user()->name;
            //return view('pages.velkommen', ['username' => $username])->withPosts($posts)->withTitle($title);
            return view('pages.velkommen', ['username' => $username])->with('posts', $posts);
        }

        //return view('pages.velkommen')->withPosts($posts)->withTitle($title);
        return view('pages.velkommen')->with('posts', $posts);
    }

}