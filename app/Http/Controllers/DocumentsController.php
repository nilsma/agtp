<?php

namespace App\Http\Controllers;

use Auth;
use DB;

class DocumentsController extends Controller
{

    public function index()
    {
        if(Auth::check()) {
            $username = Auth::user()->name;
            return view('pages.dokumenter', ['username' => $username]);
        }

        $godkjente = DB::select('select * from protocols where is_approved = ?', [1]);
        $til_godkjenning = DB::select('select * from protocols where is_approved = ?', [0]);
        $skriv = DB::select('select * from documents');

        return view('pages.dokumenter', [
            'til_godkjenning' => $til_godkjenning,
            'godkjent' => $godkjente,
            'skriv' => $skriv
        ]);
    }

}