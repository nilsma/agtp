<?php

namespace App\Http\Controllers;

use App\Protocols;
use App\Http\Controllers\Controller;
use Request;
use Illuminate\Database\QueryException;
use Auth;
use App\Documents;
use Illuminate\Support\Facades\Redirect;
use URL;

class UploadsController extends Controller
{

    public function fileExists($filename, $folder)
    {
        echo $folder . $filename;
        return file_exists($folder . $filename);
    }

    public function upload()
    {
        if(Request::file('file')->getClientOriginalExtension() == 'pdf') {

            if(Request::input('document_type') == 'skriv') {

                $document = new Documents();
                $document->id = NULL;
                $document->owner_id = Auth::user()->id;
                $document->title = Request::input('title');
                $document->filename = Request::file('file')->getClientOriginalName();
                $document->created_at = NULL;
                $document->updated_at = NULL;

                if(!file_exists(public_path('uploads/skriv/' . Request::file('file')->getClientOriginalName()))) {

                    try {

                        Request::file('file')->move(public_path('uploads/skriv/'), Request::file('file')->getClientOriginalName());
                        $document->save();

                        return Redirect::to('/dokumenter/ovrige')->with(array('alert-type' => 'alert alert-success', 'alert-message' => 'Dokumentet ble lastet opp!'));

                    } catch(QueryException $e) {

                        echo $e->getMessage();

                    }

                } else {

                    return Redirect::to('/dokumenter')->with(array('alert-type' => 'alert alert-danger', 'alert-message' => 'Skrivet (' . $document->filename . ') eksisterer allerede! Prøv på nytt!'));

                }

            } elseif(Request::input('document_type') == 'til_godkjenning') {

                $protocol = new Protocols();
                $protocol->id = NULL;
                $protocol->owner_id = Auth::user()->id;
                $protocol->is_approved = false;
                $protocol->title = Request::input('title');
                $protocol->filename = Request::file('file')->getClientOriginalName();
                $protocol->created_at = NULL;
                $protocol->updated_at = NULL;

                if(!file_exists(public_path('uploads/referater/' . Request::file('file')->getClientOriginalName()))) {

                    try {

                        Request::file('file')->move(public_path('uploads/referater/'), Request::file('file')->getClientOriginalName());
                        $protocol->save();

                        return Redirect::to('/dokumenter/styrereferater')->with(array('currentUser' => Auth::user(), 'alert-type' => 'alert alert-success', 'alert-message' => 'Referatet ble lagt til!'));

                    } catch(QueryException $e) {

                        echo $e->getMessage();

                    }

                } else {

                    return Redirect::to('/dokumenter')->with(array('alert-type' => 'alert alert-danger', 'alert-message' => 'Referatet eksisteter allerede! Prøv på nytt!'));

                }

            } elseif(Request::input('document_type') == 'godkjent') {

                $protocol = new Protocols();
                $protocol->id = NULL;
                $protocol->owner_id = Auth::user()->id;
                $protocol->is_approved = true;
                $protocol->title = Request::input('title');
                $protocol->filename = Request::file('file')->getClientOriginalName();
                $protocol->created_at = NULL;
                $protocol->updated_at = NULL;

                if(!file_exists(public_path('uploads/referater/' . Request::file('file')->getClientOriginalName()))) {

                    try {

                        Request::file('file')->move(public_path('uploads/referater/'), Request::file('file')->getClientOriginalName());
                        $protocol->save();

                        return Redirect::to('/dokumenter/styrereferater')->with(array('currentUser' => Auth::user(), 'alert-type' => 'alert alert-success', 'alert-message' => 'Referatet ble lagt til!'));

                    } catch(QueryException $e) {

                        echo $e->getMessage();

                    }

                } else {

                    return Redirect::to('/dokumenter')->with(array('alert-message' => 'Referatet eksisterer allerede!', 'alert-type' => 'alert alert-danger'));

                }

            } else {
                //
            }

        } else {

            return Redirect::to('last-opp')->with(array('alert-type' => 'alert alert-danger', 'alert-message' => 'Kun PDF-dokumenter er tillatt!'));

        }

    }

}
