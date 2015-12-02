<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use App\Protocols;

class ProtocolsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {

        if(Auth::check()) {

            $user = Auth::user();
            $protocol = Protocols::findOrFail($id);

            if ($protocol->owner_id == $user->id) {

                if($protocol->delete()) {

                    if(file_exists(public_path('uploads/referater/' . $protocol->filename))) {

                        try {

                            unlink(public_path('uploads/referater/' . $protocol->filename));

                        } catch(\Exception $e) {

                            return redirect('mine-dokumenter')->with('message', 'Noe gikk feil under sletting av referatet ' . $protocol->filename);

                        }

                        return redirect('mine-dokumenter')->with('message', $protocol->title . ' (' . $protocol->filename . ') ble slettet');

                    } else {

                        return redirect('mine-dokumenter')->with('message', 'Det referatet eksisterer ikke! Prøv på nytt!');

                    }

                } else {

                    return redirect('mine-dokumenter')->with('message', 'Noe gikk feil under sletting av referatet ' . $protocol->filename);

                }


            } else {

                return redirect('/mine-dokumenter', ['username' => $user->name])->withErrors(['Du kan ikke slette andre brukeres referater!']);

            }

        } else {

            return redirect('/')->withErrors(['You have to login first']);

        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /*
    public function destroy($id)
    {

        if(Auth::check()) {

            $user = Auth::user();
            $protocol = Protocols::findOrFail($id);

            if($protocol->owner_id == $user->id) {

                $protocol->delete();
                return redirect('mine-dokumenter')->with('message', 'Referat ' . $protocol->title . ' (' . $protocol->filename . ') ble slettet!');

            } else {

                return redirect('mine-dokumenter')->with('message', 'Du kan kun slette dine egne referater!');

            }

        } else {

            return redirect('/');

        }

    }
    */

    public function toggle($id)
    {

        if(Auth::check()) {

            $user = Auth::user();
            $protocol = Protocols::findOrFail($id);

            if($protocol->owner_id == $user->id) {

                if($protocol->is_approved) {

                    $protocol->is_approved = false;

                } else {

                    $protocol->is_approved = true;

                }

                $protocol->save();
                return redirect('mine-dokumenter')->with('message', 'Referat ' . $protocol->title . ' (' . $protocol->filename . ') har blitt oppdatert!');

            } else {

                return redirect('mine-dokumenter')->with('message', 'Du kan kun endre på referater som er dine.');

            }

        } else {

            return redirect('/');

        }

    }
}
