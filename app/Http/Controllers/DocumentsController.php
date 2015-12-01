<?php

namespace App\Http\Controllers;

use App\Documents;
use App\Http\Controllers\Controller;
use App\Protocols;
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

        $documents = Documents::where(['owner_id' => Auth::user()->id])->orderBy('created_at', 'desc')->get();
        $til_godkjenning = Protocols::where(['owner_id' => Auth::user()->id, 'is_approved' => false])->orderBy('created_at', 'desc')->get();
        $godkjente = Protocols::where(['owner_id' => Auth::user()->id, 'is_approved' => true])->orderBy('created_at', 'desc')->get();

        return view('documents.show-all', ['username' => $username, 'documents' => $documents, 'til_godkjenning' => $til_godkjenning, 'godkjente' => $godkjente]);

    }

    public function upload() {

        $username = Auth::user()->name;

        return view('documents.upload', ['username' => $username]);

    }

    public function store() {

        //

    }

    public function delete($id)
    {

        if(Auth::check()) {

            $user = Auth::user();
            $document = Documents::findOrFail($id);

            if ($document->owner_id == $user->id) {

                $document->delete();
                return redirect('mine-dokumenter')->with('message', $document->title . ' (' . $document->filename . ') ble slettet');

            } else {

                return redirect('/mine-dokumenter', ['username' => $user->name])->withErrors(['You can only delete your own documents!']);

            }

        } else {

            return redirect('/')->withErrors(['You have to login first']);

        }

    }

}