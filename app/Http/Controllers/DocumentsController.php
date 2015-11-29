<?php

namespace App\Http\Controllers;

use App\Documents;
use App\Http\Controllers\Controller;
use Auth;
use DB;
use Illuminate\Database\QueryException;
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

        if(Request::file('file')->getClientOriginalExtension() == 'pdf') {

            $doc_folder = "";

            switch(Request::input('document_type'))
            {
                case 'skriv':
                    $doc_folder = 'uploads/skriv/';
                    break;

                case 'til_godkjenning':
                    $doc_folder = 'uploads/referater/til_godkjenning/';
                    break;

                case 'godkjent':
                    $doc_folder = 'uploads/referater/godkjent/';
                    break;

            }

            $document = new Documents();
            $document->id = NULL;
            $document->owner_id = Auth::user()->id;
            $document->title = Request::input('title');
            $document->filename = Request::file('file')->getClientOriginalName();

            try {

                $document->save();

                Request::file('file')->move(public_path($doc_folder), Request::file('file')->getClientOriginalName());

                return view('member.dashboard', ['username' => Auth::user()->name]);

            } catch(QueryException $e) {

                return view('/', ['username' => Auth::user()->name])->withErrors($e->getMessage());

            }

        }

    }

}