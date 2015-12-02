@extends('app')
@section('body-id', 'velkommen')
@section('content')
    <div id="posts" class="col-lg-7">
        @if ( !$posts->count() )
            <div id="post-main">
                <p>Ingen poster foreløpig!</p>
            </div>
        @else
            @foreach( $posts as $post )
                <div class="post">
                    <div class="post-header">
                        <div>
                            <h3><a href="{{ url('/'.$post->slug) }}">{{ $post->title }}</a></h3>
                            <div>
                            @if(!Auth::guest() && ($post->author_id == Auth::user()->id || Auth::user()->is_admin()))
                                @if($post->active == '1')
                                    <a class="btn btn-primary" href="{{ url('edit/' . $post->slug) }}">Edit post</a>
                                @else
                                    <a class="btn btn-primary" href="{{ url('edit/' . $post->slug) }}">Edit draft</a>
                                @endif
                            @endif
                            </div>
                            </div>
                        <div>
                            <p>{{ $post->created_at->format('M d, Y \a\t h:i a') }}, by {{ $post->author->name }}</p>
                        </div>
                    </div>
                    <article class="post-content">
                        {!! str_limit($post->body, $limit = 1000, $end = ' ... <a href='.url("/".$post->slug).'>Read More</a>') !!}
                    </article>
                </div>
            @endforeach
            {!! $posts->render() !!}
        @endif
    </div>
    <div id="side-content" class="col-lg-5 row">
        <h2>Hva skjer</h2>
        <ul id="eventlist" class="col-lg-12">
        </ul>
    </div>
@endsection