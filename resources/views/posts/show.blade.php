@extends('app')
@section('content')
    <div id="posts" class="col-lg-12">
        <div class="post">
            <div class="post-header">
                <div>
                    <h3>{{ $post->title }}</h3>
                    @if(Auth::check() && (Auth::user()->id == $post->author_id))
                        <div>
                            <a class="btn btn-primary" href="{{ url('edit/' . $post->slug)}}">Endre</a>
                        </div>
                    @endif
                </div>
                <div>
                    <p>{{ $post->created_at->format('M d, Y \k\l. h:i a') }}, av {{ $post->author->name }}</p>
                </div>
            </div> <!-- end .post-header -->
            {!! $post->body !!}
            <div>
                @if(Auth::guest())
                    <div class="container-fluid">
                        <div class="row">
                            <div class="">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        Kommentarer
                                    </div> <!-- end .panel-heading -->
                                    <div class="panel-body">

                                        <p>Du må være <a href="logg-inn">innlogget</a> for å kunne kommentere!</p>

                                        <div class="form-group form-nav">
                                            <a class="btn btn-primary" href="/">Tilbake</a>
                                        </div>

                                        <div id="post-comments">
                                            @if(count ($comments) > 0)
                                                <ul style="list-style: none; padding: 0">
                                                    @foreach($comments as $comment)
                                                        <li class="panel-body post-comment">
                                                            <div class="list-group">
                                                                <div class="list-group-item">
                                                                    <h4>{{ $comment->author->name }}</h4>
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

                                    </div> <!-- end .panel-body -->
                                </div> <!-- end .panel .panel-default -->
                            </div> <!-- end .col-md-8 .col-md-offset-2 -->
                        </div> <!-- end .row -->
                    </div> <!-- end .container-fluid -->

                @else
                    <div class="container-fluid">
                        <div class="row">
                            <div class="">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        Kommentér
                                    </div> <!-- end .panel-heading -->
                                    <div class="panel-body">

                                        {!! Form::open(array('url' => '/comment/add')) !!}
                                        {!! Form::hidden('on_post', $post->id) !!}
                                        {!! Form::hidden('slug', $post->slug) !!}

                                        <div class="form-group">
                                            {!! Form::textarea('body', null, array('class' => 'form-control', 'size' => '30x3')) !!}
                                        </div>

                                        <div class="form-group form-nav">
                                            {!! Form::submit('Kommentér', array('class' => 'btn btn-success')) !!}
                                            <a class="btn btn-primary" href="{{ URL::previous() }}">Tilbake</a>
                                        </div>

                                        {!! Form::close() !!}

                                        <div id="post-comments">
                                            @if(count ($comments) > 0)
                                                <ul style="list-style: none; padding: 0">
                                                    @foreach($comments as $comment)
                                                        <li class="panel-body post-comment">
                                                            <div class="list-group">
                                                                <div class="list-group-item">
                                                                    <h4>{{ $comment->author->name }}</h4>
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

                                    </div> <!-- end .panel-body -->
                                </div> <!-- end .panel .panel-default -->
                            </div> <!-- end .col-md-8 .col-md-offset-2 -->
                        </div> <!-- end .row -->
                    </div> <!-- end .container-fluid -->

                @endif
            </div>
        </div> <!-- end .post -->
    </div> <!-- end #posts -->
@endsection