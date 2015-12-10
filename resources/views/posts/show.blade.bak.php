@extends('app')
@section('content')
    @if($post)
        <div class="post">
            <div class="post-header">
                    <h3>{{ $post->title }}</h3>
                    <p>{{ $post->created_at->format('M d, Y \k\l. h:i a') }}, av {{ $post->author->name }}</p>
                    @if(!Auth::guest() && ($post->author_id == Auth::user()->id || Auth::user()->is_admin()))
                        <a class="btn btn-primary" href="{{ url('edit/'.$post->slug)}}">Endre</a>
                    @endif
            </div> <!-- end .post-header -->
            {!! $post->body !!}
            <h2>Kommentér</h2>
            @if(Auth::guest())
                <p>Du må logge inn for å kommentere poster!</p>
            @else
                <div class="panel-body">
                    <form method="post" action="/comment/add">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="on_post" value="{{ $post->id }}">
                        <input type="hidden" name="slug" value="{{ $post->slug }}">
                        <div class="form-group">
                            <textarea required="required" placeholder="Kommentér her" name = "body" class="form-control"></textarea>
                        </div> <!-- .form-group -->
                        <input type="submit" name='post_comment' class="btn btn-success" value = "Post"/>
                    </form>
                </div> <!-- end .panel-body -->
            @endif
            <div id="post-comments">
                @if($comments)
                    <ul style="list-style: none; padding: 0">
                        @foreach($comments as $comment)
                            <li class="panel-body post-comment">
                                <div class="list-group">
                                    <div class="list-group-item">
                                        <h3>{{ $comment->author->name }}</h3>
                                        <p>{{ $comment->created_at->format('M d,Y \a\t h:i a') }}</p>
                                    </div> <!-- end list-group-item -->
                                    <div class="list-group-item">
                                        <p>{{ $comment->body }}</p>
                                    </div> <!-- end list-group-item -->
                                </div> <!-- end list-group -->
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div> <!-- end #post-comments -->
        </div> <!-- end .post -->
    @endif
@endsection
