<?php

namespace App\Http\Controllers;

use App\Posts;
use Redirect;
use App\Http\Requests\PostFormRequest;
use Illuminate\Http\Request;
use Auth;
use DB;
use App\Comments;
use URL;

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

    public function landingPage(Request $request)
    {

        switch($request->input('sorting-drafts')) {
            case null:
                $orderDraftsBy = 'created_at';
                $orderDraftsDirection = 'desc';
                break;

            case 'created_at':
                $orderDraftsBy = 'created_at';
                $orderDraftsDirection = 'desc';
                break;

            case 'title':
                $orderDraftsBy = 'title';
                $orderDraftsDirection = 'asc';
                break;
        }

        switch($request->input('sorting-published')) {
            case null:
                $orderPublishedBy = 'created_at';
                $orderPublishedDirection = 'desc';
                break;

            case 'created_at':
                $orderPublishedBy = 'created_at';
                $orderPublishedDirection = 'desc';
                break;

            case 'title':
                $orderPublishedBy = 'title';
                $orderPublishedDirection = 'asc';
                break;
        }

        $currentUser = Auth::user();
        $published = Posts::where('active', 1)->orderBy($orderPublishedBy, $orderPublishedDirection)->get();
        $drafted = Posts::where('author_id', $currentUser->id)->where('active', 0)->orderBy($orderDraftsBy, $orderDraftsDirection)->get();
        $sortValues = array(
            'created_at' => 'Opprettet',
            'title' => 'Tittel',
        );

        return view(
            'posts.landing',
            array(
                'currentUser' => $currentUser,
                'published' => $published,
                'drafted' => $drafted,
                'sortValues' => $sortValues,
                'orderPublishedBy' => $orderPublishedBy,
                'orderDraftsBy' => $orderDraftsBy
            )
        );

    }

    public function showOwnPosts(Request $request)
    {

        switch($request->input('sorting-drafts')) {
            case null:
                $orderDraftsBy = 'created_at';
                $orderDraftsDirection = 'desc';
                break;

            case 'created_at':
                $orderDraftsBy = 'created_at';
                $orderDraftsDirection = 'desc';
                break;

            case 'title':
                $orderDraftsBy = 'title';
                $orderDraftsDirection = 'asc';
                break;
        }

        switch($request->input('sorting-published')) {
            case null:
                $orderPublishedBy = 'created_at';
                $orderPublishedDirection = 'desc';
                break;

            case 'created_at':
                $orderPublishedBy = 'created_at';
                $orderPublishedDirection = 'desc';
                break;

            case 'title':
                $orderPublishedBy = 'title';
                $orderPublishedDirection = 'asc';
                break;
        }

        $currentUser = Auth::user();
        $published = Posts::where('active', 1)
            ->orderBy($orderPublishedBy, $orderPublishedDirection)
            ->where('author_id', Auth::id())
            ->get();
        $drafted = Posts::where('author_id', $currentUser->id)->where('active', 0)->orderBy($orderDraftsBy, $orderDraftsDirection)->get();
        $sortValues = array(
            'created_at' => 'Opprettet',
            'title' => 'Tittel',
        );

        return view(
            'posts.landing',
            array(
                'currentUser' => $currentUser,
                'published' => $published,
                'drafted' => $drafted,
                'sortValues' => $sortValues,
                'orderPublishedBy' => $orderPublishedBy,
                'orderDraftsBy' => $orderDraftsBy
            )
        );

    }

    /**
     * Returns the view for creating new post
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Request $request) {

        if(Auth::check() && $request->user()->can_post()) {
            $currentUser = Auth::user();

            return view('posts.create', array('currentUser' => $currentUser));

        } else {

            return view('/');

        }

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

        return redirect('/admin/poster/alle')->with(array('alert-message' => $message, 'alert-type' => 'alert alert-success'));
        #return redirect('edit/' . $post->slug)->with(array('alert-message' => $message, 'alert-type' => 'alert alert-success'));
    }


    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {

        $post = Posts::where('slug', $slug)->first();

        if(!$post) {
            return redirect('/')->withErrors('requested page not found');
        }

        $comments = Comments::where('on_post', '=', $post->id)->orderBy('created_at', 'desc')->get();

        if(Auth::check()) {

            return view('posts.show')->with(array('currentUser' => Auth::user(), 'post' => $post, 'comments' => $comments));

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
    public function edit(Request $request, $slug)
    {

        $post = Posts::where('slug',$slug)->first();

        if($post && ($request->user()->id == $post->author_id || $request->user()->is_admin()))
            return view('posts.edit', array('currentUser' => Auth::user()))->with('post',$post);

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

        if($post && ($request->user()->role == 'author' || $request->user()->is_admin())) {

            $title = $request->input('title');
            $slug = str_slug($title);
            $duplicate = Posts::where('slug',$slug)->first();

            if($duplicate) {

                if($duplicate->id != $post_id) {

                    return redirect('/admin/poster/rediger/'.$post->slug)->withErrors('Title already exists.')->withInput();

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

            } else {

                $post->active = 1;
                $message = 'Posten ble oppdatert!';
                $message_type = 'alert alert-success';

            }

            $post->save();

            return Redirect::to('/admin/poster/alle')->with(array('alert-message' => $message, 'alert-type' => $message_type));

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

        return Redirect::to('/admin/poster/alle')->with($data);

    }

}
