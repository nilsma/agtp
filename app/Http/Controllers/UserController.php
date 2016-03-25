<?php

namespace App\Http\Controllers;

use App\EmailVerifications;
use App\Http\Requests;
use App\MemberApplications;
use App\User;
use App\Posts;
use App\VerifiedEmails;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Auth;
use Hash;
use Redirect;
use Validator;
use Illuminate\Support\Facades\Mail;
use Config;

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

    private function prefaceValidationRules() {
        return [
            'name' => 'required|max:32|string|unique:users|unique:email_verifications',
            'email' => 'required|max:64|email|unique:users|unique:email_verifications',
            'password' => 'required|max:16',
            'password_confirmation' => 'required|max:16|same:password'
        ];
    }

    public function alertMemberApplication(MemberApplications $ma) {

        Mail::send('email.member_application', ['ma' => $ma], function ($message) use ($ma) {
            $message->from("nils.martinussen@gmail.com");
            $message->to("leder@austegardstoppen.no")->subject("Søknad medlemskap Austegardstoppen.");
        });

    }

    /**
     * user registration preface
     */
    public function registrationPreface(Request $request) {

        $validation_data = array(
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            'password_confirmation' => $request->input('password_confirmation')
        );

        $validator = Validator::make($validation_data, $this->prefaceValidationRules());

        if($validator->fails()) {

            return Redirect::to('registrer')->with('errors', $validator->messages());

        } else {

            $ma = new MemberApplications();
            $ma->name = $request->input('name');
            $ma->email = $request->input('email');
            $ma->password = bcrypt($request->input('password'));
            $ma->save();

            if($ve = VerifiedEmails::where('email', $ma->email)->first()) {

                $this->emailVerificationPreface($ma);
                $this->alertMemberApplication($ma);
                $ma->delete();
                return Redirect::to('/verification')->with(array('alert-type' => 'alert alert-success', 'alert-message' => 'Du vil snarlig motta en epost for bekreftelse!'));

            } else {

                $this->alertMemberApplication($ma);
                return Redirect::to('/verification')->with(array('alert-type' => 'alert alert-success', 'alert-message' => 'Søknaden din er registrert og vi sender deg en epost for bekreftelse så snart som mulig!'));

            }

        }

    }

    public function emailVerificationPreface(MemberApplications $ma) {

        $ev = new EmailVerifications();
        $ev->name = $ma->name;
        $ev->email = $ma->email;
        $ev->password = $ma->password;
        $ev->token = str_random(32);
        $ev->save();

        $this->sendEmailVerification($ev);

    }

    /**
     * Send an e-mail reminder to the user.
     *
     */
    public function sendEmailVerification(EmailVerifications $ev) {

        Mail::send('email.verification', ['ev' => $ev], function ($message) use ($ev) {
            $message->from("nils.martinussen@gmail.com");
            $message->to($ev->email)->subject("Brukerregistrering - Austegardstoppen");
        });

    }

    public function verify_user($token) {

        $ev = EmailVerifications::where('token', $token)->first();

        $user = new User();
        $user->id = null;
        $user->name = $ev->name;
        $user->email = $ev->email;
        $user->password = $ev->password;
        $user->role = 'subscriber';
        $user->remember_token = null;

        $user->save();

        $ev->delete();

        Auth::login($user);

        return Redirect::to('/')->with(array('alert-type' => 'alert alert-success', 'alert-message' => 'Du er nå registrert og logget inn!'));

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
