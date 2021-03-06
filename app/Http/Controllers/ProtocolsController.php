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

            $currentUser = Auth::user();
            $protocol = Protocols::findOrFail($id);

            if ($protocol->owner_id == $currentUser->id) {

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

                return Redirect::to('mine-dokumenter')->with(array('currentUser' => $currentUser, 'alert-type' => 'alert alert-danger', 'alert-message' => 'Du kan ikke slette andre brukeres referater!'));

            }

        } else {

            return Redirect::to('/')->with(array('alert-type' => 'alert alert-danger', 'alert-message' => 'Du må loge inn først!'));

        }

    }

    public function toggleApproval($id)
    {

        if(Auth::check()) {

            $currentUser = Auth::user();
            $protocol = Protocols::findOrFail($id);

            if($protocol->owner_id == $currentUser->id) {

                if($protocol->is_approved) {

                    $protocol->is_approved = false;

                } else {

                    $protocol->is_approved = true;

                }

                $protocol->save();
                return Redirect::to('/dokumenter/styrereferater')->with(array('alert-type' => 'alert alert-success', 'alert-message' => 'Referatet ble oppdatert'));

            } else {

                return Redirect::to('/dokumenter/styrereferater')->with(array('alert-type' => 'alert alert-danger', 'alert-message' => 'Du kan kun endre på dine egne referater'));

            }

        } else {

            return redirect('/');

        }

    }
}
