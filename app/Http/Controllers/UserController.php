<?php

namespace App\Http\Controllers;

use App\EmailVerifications;
use App\Http\Requests;
use App\User;
use App\Posts;
use Illuminate\Http\Request;
use Auth;
use Hash;
use Redirect;
use Validator;

class UserController extends Controller {

    public function changePassword(Request $request) {

        if($request->input('new_password') == $request->input('repeat_password')) {

            $user = Auth::user();

            if(Hash::check($request->input('old_password'), $user->password)) {

                $user->password = Hash::make($request->input('new_password'));
                $user->save();

                $view_params = ['type' => 'alert alert-success', 'message' => 'Passordet ble oppdatert!'];

                return Redirect::to('/endre-passord')->with($view_params);

            } else {

                $view_params = ['type' => 'alert alert-warning', 'message' => 'Det gamle passordet du oppgav var feil!'];
                return Redirect::to('/endre-passord')->with($view_params);

            }

        } else {

            return Redirect::to('/endre-passord')->with(['type' => 'alert alert-warning', 'message' => 'De nye passordene må være like!']);

        }

    }

    private function preface_validation_rules() {
        return [
            'name' => 'required|string|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'password_confirmation' => 'required|same:password',
            'token' => 'required|unique:email_verifications'
        ];
    }

    /**
     * user registration preface
     */
    public function registration_preface(Request $request) {

        $validation_token = str_random(64);

        $validation_data = array(
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            'password_confirmation' => $request->input('password_confirmation'),
            'token' => $validation_token
        );

        $validator = Validator::make($validation_data, $this->preface_validation_rules());

        if($validator->fails()) {

            return Redirect::to('registrer')->with('errors', $validator->messages());

        } else {

            if(EmailVerifications::where('email', 'LIKE', $request->input('email'))->firstOrFail()) {

                $email_verification = EmailVerifications::where('email', 'LIKE', $request->input('email'))->firstOrFail();

            } else {

                $email_verification = new EmailVerifications();

            }

            $email_verification->name = $request->input('name');
            $email_verification->email = $request->input('email');
            $email_verification->password = bcrypt($request->input('password'));
            $email_verification->token = $validation_token;

        }

        $email_verification->save();

        echo 'now send mail ...';

    }

    /**
     * Display active posts of a particular user
     *
     * @param int $id
     * @return view
     */
    public function user_posts($id)
    {
        $posts = Posts::where('author_id',$id)->where('active',1)->orderBy('created_at','desc')->paginate(5);
        $title = User::find($id)->name;

        return view('home')->withPosts($posts)->withTitle($title);
    }

    /**
     * Display all of the posts of a particular user
     *
     * @param Request $request
     * @return view
     */
    public function user_posts_all(Request $request)
    {
        //
        $user = $request->user();
        $posts = Posts::where('author_id',$user->id)->orderBy('created_at','desc')->paginate(5);
        $title = $user->name;
        return view('posts.show-all')->withPosts($posts)->withTitle($title);
    }

    /**
     * Display draft posts of a currently active user
     *
     * @param Request $request
     * @return view
     */
    public function user_posts_draft(Request $request)
    {
        //
        $user = $request->user();
        $posts = Posts::where('author_id',$user->id)->where('active',0)->orderBy('created_at','desc')->paginate(5);
        $title = $user->name;
        return view('home')->withPosts($posts)->withTitle($title);
    }

    /**
     * profile for user
     */
    public function profile(Request $request, $id)
    {
        $data['user'] = User::find($id);
        if (!$data['user'])
            return redirect('/');
        if ($request -> user() && $data['user'] -> id == $request -> user() -> id) {
            $data['author'] = true;
        } else {
            $data['author'] = null;
        }
        $data['comments_count'] = $data['user'] -> comments -> count();
        $data['posts_count'] = $data['user'] -> posts -> count();
        $data['posts_active_count'] = $data['user'] -> posts -> where('active', '1') -> count();
        $data['posts_draft_count'] = $data['posts_count'] - $data['posts_active_count'];
        $data['latest_posts'] = $data['user'] -> posts -> where('active', '1') -> take(5);
        $data['latest_comments'] = $data['user'] -> comments -> take(5);
        return view('admin.profile', $data);
    }

    public function dashboard() {

        if(Auth::check()) {
            $username = Auth::user()->name;
            return view('member.dashboard', ['username' => $username]);
        }

        return view('member.dashboard');

    }
}
