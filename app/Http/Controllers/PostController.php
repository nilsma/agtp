<?php

namespace App\Http\Controllers;

use App\Posts;
use Redirect;
use App\Http\Requests\PostFormRequest;
use Illuminate\Http\Request;
use Auth;
use DB;

class PostController extends Controller
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

    public function create(Request $request) {

        if(Auth::check() && $request->user()->can_post()) {
            $username = Auth::user()->name;

            return view('posts.create', ['username' => $username]);

        } else {

            return view('pages.velkommen');

        }

    }

    public function my_posts(Request $request) {

        if(!Auth::check()) {

            return Redirect::to('/')->with(array('alert-type' => 'alert alert-danger', 'alert-message' => 'Du må logge inn først!'));

        }

        $posts = Posts::where('author_id',$request->user()->id)->orderBy('created_at','desc')->paginate(5);

        return view('posts.show-all', ['username' => $request->user()->name])->withPosts($posts);

    }

    public function all_posts()
    {

        if(!Auth::check()) {

            return Redirect::to('/')->with(array('alert-type' => 'alert alert-danger', 'alert-message' => 'Du må logge inn først!'));

        }

        $posts = Posts::all();

        return view('posts.show-all')->with(array('username' => Auth::user()->name, 'posts' => $posts));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  PostFormRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostFormRequest $request)
    {
        $post = new Posts();
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->slug = str_slug($post->title);
        $post->author_id = $request->user()->id;

        if($request->has('save')) {
            $post->active = 0;
            $message = 'Posten ble lagret!';
        } else {
            $post->active = 1;
            $message = 'Posten ble publisert!';
        }

        $post->save();

        return redirect('edit/' . $post->slug)->with(array('alert-message' => $message, 'alert-type' => 'alert alert-success'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {

        $post = Posts::where('slug',$slug)->first();

        if(!$post) {
            return redirect('/')->withErrors('requested page not found');
        }

        $comments = $post->comments;

        if(Auth::check()) {

            $username = Auth::user()->name;

            return view('posts.show', ['username' => $username])->withPost($post)->withComments($comments);

        } else {

            return view('posts.show')->withPost($post)->withComments($comments);

        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$slug)
    {
        $post = Posts::where('slug',$slug)->first();
        if($post && ($request->user()->id == $post->author_id || $request->user()->is_admin()))
            return view('posts.edit', ['username' => $request->user()->name])->with('post',$post);

        return redirect('/')->withErrors('you have not sufficient permissions');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $post_id = $request->input('post_id');
        $post = Posts::find($post_id);
        if($post && ($post->author_id == $request->user()->id || $request->user()->is_admin())) {
            $title = $request->input('title');
            $slug = str_slug($title);
            $duplicate = Posts::where('slug',$slug)->first();
            if($duplicate) {
                if($duplicate->id != $post_id) {
                    return redirect('edit/'.$post->slug)->withErrors('Title already exists.')->withInput();
                } else {
                    $post->slug = $slug;
                }
            }

            $post->title = $title;
            $post->body = $request->input('body');
            if($request->has('save')) {
                $post->active = 0;
                $message = 'Posten ble lagret!';
                $message_type = 'alert alert-success';
                $landing = 'edit/'.$post->slug;
            } else {
                $post->active = 1;
                $message = 'Posten ble oppdatert!';
                $message_type = 'alert alert-success';
                # $landing = $post->slug;
                $landing = 'edit/'.$post->slug;
            }
            $post->save();

            return Redirect::to($landing)->with(array('alert-message' => $message, 'alert-type' => $message_type));
            # return redirect($landing)->withMessage($message);

        } else {
            return redirect('/')->withErrors('you have not sufficient permissions');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {

        $post = Posts::find($id);

        if($post && ($post->author_id == Auth::user()->id || $request->user()->is_admin())) {

            try {

                $post->delete();
                $data = array('alert-type' => 'alert alert-success', 'alert-message' => 'Posten ble slettet!');

            } catch(\Exception $e) {



            }

        } else {

            $data = array('alert-type' => 'alert alert-danger', 'alert-message' => 'Du har ikke tilgang til å slette denne posten!');

        }

        return Redirect::to('/mine-poster')->with($data);

    }

}
