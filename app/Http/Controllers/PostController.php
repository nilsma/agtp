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

    public function testcreate(Request $request) {

        echo $request->title;
        echo $request->body;

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
            redirect('/');
        }

        $posts = Posts::where('author_id',$request->user()->id)->orderBy('created_at','desc')->paginate(5);

        return view('posts.show-all', ['username' => $request->user()->name])->withPosts($posts);
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
            $message = 'Post saved successfully';
        } else {
            $post->active = 1;
            $message = 'Post published successfully';
        }

        $post->save();

        return redirect('edit/' . $post->slug)->withMessage($message);
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
        if($post && ($post->author_id == $request->user()->id || $request->user()->is_admin()))
        {
            $title = $request->input('title');
            $slug = str_slug($title);
            $duplicate = Posts::where('slug',$slug)->first();
            if($duplicate)
            {
                if($duplicate->id != $post_id)
                {
                    return redirect('edit/'.$post->slug)->withErrors('Title already exists.')->withInput();
                }
                else
                {
                    $post->slug = $slug;
                }
            }
            $post->title = $title;
            $post->body = $request->input('body');
            if($request->has('save'))
            {
                $post->active = 0;
                $message = 'Post saved successfully';
                $landing = 'edit/'.$post->slug;
            }
            else {
                $post->active = 1;
                $message = 'Post updated successfully';
                $landing = $post->slug;
            }
            $post->save();
            return redirect($landing)->withMessage($message);
        }
        else
        {
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
        if($post && ($post->author_id == $request->user()->id || $request->user()->is_admin()))
        {
            $post->delete();
            $data['message'] = 'Post deleted Successfully';
        }
        else
        {
            $data['errors'] = 'Invalid Operation. You have not sufficient permissions';
        }
        return redirect('/')->with($data);
    }
}
