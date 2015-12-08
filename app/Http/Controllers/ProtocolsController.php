<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use App\Protocols;
use Redirect;

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

                            return Redirect::to('mine-dokumenter')->with(array('alert-type' => 'alert alert-danger', 'alert-message' => 'Noe gikk feil ved sletting av referatet!'));

                        }

                        return Redirect::to('mine-dokumenter')->with(array('alert-type' => 'alert alert-success', 'alert-message' => 'Referatet ble slettet!'));

                    } else {

                        return Redirect::to('mine-dokumenter')->with(array('alert-type' => 'alert alert-danger', 'alert-message' => 'Det referatet eksisterer ikke! Prøv på nytt!'));

                    }

                } else {

                    return Redirect::to('mine-dokumenter')->with(array('alert-type' => 'alert alert-danger', 'alert-message' => 'Noe gikk feil ved sletting av referatet!'));

                }


            } else {

                return Redirect::to('mine-dokumenter')->with(array('username' => $user->name, 'alert-type' => 'alert alert-danger', 'alert-message' => 'Du kan ikke slette andre brukeres referater!'));

            }

        } else {

            return Redirect::to('/')->with(array('alert-type' => 'alert alert-danger', 'alert-message' => 'Du må loge inn først!'));

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
