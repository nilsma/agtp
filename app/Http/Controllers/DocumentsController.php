<?php

namespace App\Http\Controllers;

use App\Documents;
use App\Protocols;
use Auth;
use DB;
use Request;
use Redirect;

class DocumentsController extends Controller
{

    public function index()
    {


        $godkjente = Protocols::where('is_approved', '=', true)->orderBy('created_at', 'asc')->get();
        $til_godkjenning = Protocols::where('is_approved', '=', false)->orderBy('created_at', 'asc')->get();
        $skriv = Documents::orderBy('created_at', 'asc')->get();

        if(Auth::check()) {

            return view('pages.dokumenter', [
                'currentUser' => Auth::user(),
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

    public function all_documents() {

        if(!Auth::check() || Auth::user()->role != 'admin') {

            return Redirect::to('/dashboard')->with(array('alert-message' => 'Du må være administrator!', 'alert-type' => 'alert alert-danger'));

        }

        $godkjente = Protocols::where(['is_approved' => 1])->orderBy('created_at', 'desc')->get();
        $til_godkjenning = Protocols::where(['is_approved' => 0])->orderBy('created_at', 'desc')->get();
        $documents = Documents::all();

        return view('documents.show-all', array(
            'currentUser' => Auth::user(),
            'documents' => $documents,
            'godkjente' => $godkjente,
            'til_godkjenning' => $til_godkjenning
        ));

    }

    public function my_documents() {

        if(!Auth::check()) {
            redirect('/');
        }

        $documents = Documents::where(['owner_id' => Auth::user()->id])->orderBy('created_at', 'desc')->get();
        $til_godkjenning = Protocols::where(['owner_id' => Auth::user()->id, 'is_approved' => false])->orderBy('created_at', 'desc')->get();
        $godkjente = Protocols::where(['owner_id' => Auth::user()->id, 'is_approved' => true])->orderBy('created_at', 'desc')->get();

        return view('documents.show-mine', [
            'currentUser' => Auth::user(), 'documents' => $documents, 'til_godkjenning' => $til_godkjenning, 'godkjente' => $godkjente
        ]);

    }

    public function upload() {

        return view('documents.upload', array('currentUser' => Auth::user()));

    }

    public function store() {

        //

    }

    public function destroy($id)
    {

        if(Auth::check()) {

            $currentUser = Auth::user();
            $document = Documents::findOrFail($id);
            $folder = 'uploads/skriv/';

            if ($document->owner_id == $currentUser->id) {

                if($document->delete()) {

                    if(file_exists(public_path($folder . $document->filename))) {

                        try {

                            unlink(public_path($folder . $document->filename));

                        } catch(\Exception $e) {

                            return Redirect::to('mine-dokumenter')->with(array('alert-type' => 'alert alert-danger', 'alert-message' => 'Noe gikk feil under sletting av skrivet!'));

                        }

                        return Redirect::to('mine-dokumenter')->with(array('alert-type' => 'alert alert-success', 'alert-message' => 'Dokumentet ble slettet!'));

                    } else {

                        return redirect('mine-dokumenter')->with('message', 'Det skrivet eksisterer ikke! Prøv på nytt!');

                    }

                } else {

                    return redirect('mine-dokumenter')->with('message', 'Noe gikk feil under sletting av skrivet ' . $document->filename);

                }


            } else {

                return redirect('/mine-dokumenter', array('currentUser' => Auth::user()))->withErrors(['Du kan ikke slette andre brukeres referater!']);

            }

        } else {

            return redirect('/')->withErrors(['Du må være innlogget for å kunne slette dokumenter!']);

        }

    }

}