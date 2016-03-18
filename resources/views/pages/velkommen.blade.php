@extends('app')
@section('body-id', 'velkommen')
@section('content')
    <div class="row">
        <div id="posts" class="col-xs-12 col-sm-12 col-md-7 col-lg-7">
            @if ( !$posts->count() )
                <div id="post-main">
                    <p>Ingen poster foreløpig!</p>
                </div> <!-- end #post-main -->
            @else
                @foreach( $posts as $post )
                    <div class="post">
                        <div class="post-header">
                            <div>
                                <h3><a href="{{ url('/' . $post->slug) }}">{{ $post->title }}</a></h3>
                                <div>
                                    @if(Auth::check() && ($post->author_id == Auth::user()->id || Auth::user()->role == 'admin'))
                                        @if($post->active == '1')
                                            <a class="" href="{{ url('edit/' . $post->slug) }}">Endre post</a>
                                        @else
                                            <a class="btn btn-primary" href="{{ url('edit/' . $post->slug) }}">Endre kladd</a>
                                        @endif
                                    @endif
                                </div>
                            </div>
                            <div>
                                <!--
                            <p>{{ $post->created_at->format('M d, Y \a\t h:i a') }}, av {{ $post->author->name }}
                                        - <a href="{{ url('/' . $post->slug) }}">kommentarer ({{ count($post->comments) }})</a>
                            </p>
                            -->
                                <p>{{ $post->created_at->format('d\. M, Y \k\l\. H:i') }}, av {{ $post->author->name }}
                                    - <a href="{{ url('/' . $post->slug) }}">kommentarer ({{ count($post->comments) }})</a>
                                </p>
                            </div>
                        </div> <!-- .post-header -->
                        <article class="post-content">
                            {!! str_limit($post->body, $limit = 1000, $end = ' ... <a href='.url("/".$post->slug).'>Read More</a>') !!}
                        </article>
                    </div> <!-- .post -->
                @endforeach
                {!! $posts->render() !!}
            @endif
        </div> <!-- #posts -->
        <div id="side-content" class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
            <div class="inner-side">
                <h3>Hva skjer</h3>
                <ul id="eventlist" class="col-lg-12">
                </ul>
            </div> <!-- .inner-side -->
        </div> <!-- #side-content -->
    </div> <!-- .container -->
@endsection