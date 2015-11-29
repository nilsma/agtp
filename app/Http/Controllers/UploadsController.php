<?php

namespace App\Http\Controllers;

use App\Protocols;
use App\Http\Controllers\Controller;
use Request;
use Illuminate\Database\QueryException;
use Auth;
use App\Documents;

class UploadsController extends Controller
{

    public function upload(Request $request)
    {
        if(Request::file('file')->getClientOriginalExtension() == 'pdf') {

            switch(Request::input('document_type'))
            {
                case 'skriv':
                    $doc_folder = 'uploads/skriv/';
                    $title = Request::input('title');
                    $filename = Request::file('file')->getClientOriginalName();
                    $this->saveDocument($title, $filename, $doc_folder);
                    break;

                case 'til_godkjenning':
                    $doc_folder = 'uploads/referater/til_godkjenning/';
                    $is_approved = false;
                    $title = Request::input('title');
                    $filename = Request::file('file')->getClientOriginalName();
                    $this->saveProtocol($title, $filename, $doc_folder, $is_approved);
                    break;

                case 'godkjent':
                    $doc_folder = 'uploads/referater/godkjent/';
                    $is_approved = true;
                    $title = Request::input('title');
                    $filename = Request::file('file')->getClientOriginalName();
                    $this->saveProtocol($title, $filename, $doc_folder, $is_approved);
                    break;

            }

            return redirect()->route('last-opp')->with('message', Request::file('file')->getClientOriginalName() . ' uploaded!');

        } else {

            return redirect()->route('mine-dokumenter')->withErrors(['only PDF is allowed for the time being']);

        }

    }

    private function saveDocument($title, $filename, $doc_folder)
    {

        $document = new Documents();
        $document->id = NULL;
        $document->owner_id = Auth::user()->id;
        $document->title = $title;
        $document->filename = $filename;
        $document->created_at = NULL;
        $document->updated_at = NULL;

        try {

            $document->save();

            Request::file('file')->move(public_path($doc_folder), Request::file('file')->getClientOriginalName());

        } catch(QueryException $e) {

            return redirect()->route('/')->withErrors($e->getMessage());

        }

    }

    private function saveProtocol($title, $filename, $doc_folder, $is_approved)
    {

        $protocol = new Protocols();
        $protocol->id = NULL;
        $protocol->owner_id = Auth::user()->id;
        $protocol->is_approved = $is_approved;
        $protocol->title = $title;
        $protocol->filename = $filename;
        $protocol->created_at = NULL;
        $protocol->updated_at = NULL;

        try {

            Request::file('file')->move(public_path($doc_folder), Request::file('file')->getClientOriginalName());

            $protocol->save();

        } catch(QueryException $e) {

            return redirect()->route('/')->withErrors($e->getMessage());

        }

    }

}
