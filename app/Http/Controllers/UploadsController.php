<?php

namespace App\Http\Controllers;

use App\Protocols;
use App\Http\Controllers\Controller;
use Request;
use Illuminate\Database\QueryException;
use Auth;
use App\Documents;
use Illuminate\Support\Facades\Redirect;

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
                        \Session::flash('message', 'Dokumentet ble lagt til!');
                        return redirect()->route('last-opp', ['username' => Auth::user()->name]);

                    } catch(QueryException $e) {

                        echo $e->getMessage();

                    }

                } else {

                    return redirect('last-opp')->with('message', 'Skrivet (' . $document->filename . ') eksisterer allerede! Prøv på nytt!');

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
                        \Session::flash('message', 'Referatet ble lagt til!');
                        return redirect()->route('last-opp', ['username' => Auth::user()->name]);

                    } catch(QueryException $e) {

                        echo $e->getMessage();

                    }

                } else {

                    return redirect('last-opp')->with('message', 'Referatet (' . $protocol->filename . ') eksisterer allerede! Prøv på nytt!');

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
                        \Session::flash('message', 'Referatet ble lagt til!');
                        return redirect()->route('last-opp', ['username' => Auth::user()->name]);

                    } catch(QueryException $e) {

                        echo $e->getMessage();

                    }

                } else {

                    return redirect('last-opp')->with('message', 'Referatet (' . $protocol->filename . ') eksisterer allerede! Prøv på nytt');

                }

            } else {
                //
            }

        } else {

            return redirect()->route('last-opp')->with('message', 'Kun PDF-dokumenter tillatt for tiden! Prøv på nytt.');

        }

    }

}
