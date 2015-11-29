<?php

namespace App\Http\Controllers;

use App\Documents;
use App\Http\Controllers\Controller;
use Auth;
use DB;
use Illuminate\Support\Facades\Input;
use Request;

class DocumentsController extends Controller
{

    public function index()
    {

        $godkjente = DB::select('select * from protocols where is_approved = ?', [1]);
        $til_godkjenning = DB::select('select * from protocols where is_approved = ?', [0]);
        $skriv = DB::select('select * from documents');

        if(Auth::check()) {
            $username = Auth::user()->name;

            return view('pages.dokumenter', [
                'username' => $username,
                'til_godkjenning' => $til_godkjenning,
                'godkjent' => $godkjente,
                'skriv' => $skriv
            ]);
        }

        return view('pages.dokumenter', [
            'til_godkjenning' => $til_godkjenning,
            'godkjent' => $godkjente,
            'skriv' => $skriv
        ]);
    }

    public function my_documents() {

        if(!Auth::check()) {
            redirect('/');
        }

        $username = Auth::user()->name;

        $documents = Documents::where('owner_id', Auth::user()->id)->orderBy('created_at', 'desc')->get();
        return view('documents.show-all', ['username' => $username, 'documents' => $documents]);

    }

    public function upload() {

        $username = Auth::user()->name;

        return view('documents.upload', ['username' => $username]);

    }

    public function store(Request $request) {

        /*
        $title = Request::input('title');
        $file = Request::file('file');
        $extension = Request::file('file')->getClientOriginalExtension();
        $filename = Request::file('file')->getClientOriginalName();

        echo $title . " --- " . $file . " --- " . $filename . " --- " . $extension;
        */

        Request::file('file')->move(public_path('uploads/skriv/'), Request::file('file')->getClientOriginalName());

        return view('member.dashboard', ['username' => Auth::user()->name]);

    }

}