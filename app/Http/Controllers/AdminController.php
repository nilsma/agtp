<?php

namespace App\Http\Controllers;

use App\MemberApplications;
use Auth;
use App\User;
use Request;
use Redirect;

class AdminController extends Controller
{

    public function index()
    {
        if(Auth::check()) {

            return view('admin.dashboard', ['username' => Auth::user()->name]);

        } else {

            return Redirect::to('/dashboard')->with(['alert' => 'alert alert-warning', 'message' => 'Noe gikk feil!']);

        }

    }

    public function edit_user()
    {

        if(Auth::check() && Auth::user()->role == 'admin') {

            $user = User::find(Request::input('user_id'));
            $user->name = Request::input('name');
            $user->email = Request::input('email');
            $user->role = Request::input('role');

            if($user->save()) {

                return Redirect::to('admin/users')->with(['alert-type' => 'alert alert-success', 'alert-message' => 'Brukeren ble oppdatert!']);

            } else {

                return Redirect::to('admin/user_edit/' . $user->id)->with(['alert-type' => 'alert alert-warning', 'alert-message' => 'Noe gikk feil under lagring! Prøv igjen!']);

            }

        } else {

            return Redirect::to('/dashboard')->with(['alert-type' => 'alert alert-warning', 'alert-message' => 'Noe gikk feil!']);

        }

    }

    public function user_edit($id)
    {

        $user = User::find($id);

        return view('admin.user_edit', ['edit_user' => $user, 'username' => Auth::user()->name]);

    }

    public function user_administration($column = null)
    {
        if($column == null) {
            $column = 'name';
        }

        $member_applications = MemberApplications::all()->sortBy('email');
        $users = User::all()->sortBy($column);

        return view('admin.user_administration', ['username' => Auth::user()->name, 'member_applications' => $member_applications, 'users' => $users]);

    }

}