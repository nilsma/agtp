@extends('app')

@section('content')

    <div id="kladder" class="row profile-posts container-fluid">
        <div class="post-header-admin">
            <!-- <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6"> -->
            <div>
                <h3>Kladder</h3>
            </div>
            @if(count($drafted) > 0)
                    <!-- <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6"> -->
            <div>
                {!! Form::open(array('url' => '/poster', 'method' => 'POST', 'class' => 'form-horizontal', 'role' => 'form')) !!}
                {!! Form::select('sorting-drafts', $sortValues, $orderDraftsBy, array('id' => 'orderDraftsBy')) !!}
                {!! Form::submit('Sortér') !!}
                {!! Form::close() !!}
            </div>
            @endif
        </div>
        @if(count($drafted) > 0)
            @foreach($drafted as $post)
                <div class="profile-post">

                    <div class="post-header">
                        <div>
                            <h4><a href="{{ url('/' . $post->slug) }}">{{ $post->title }}</a></h4>
                            <div>
                                <a class="btn btn-primary" href="{{ url('edit/' . $post->slug) }}">Endre kladd</a>
                            </div>
                        </div>
                        <div>
                            <p>{{ $post->created_at->format('d\. M, Y \k\l\. H:i') }}, av {{ $post->author->name }}
                                - <a href="{{ url('/' . $post->slug) }}">kommentarer ({{ count($post->comments) }})</a></p>
                        </div>
                    </div>

                    <article class="post-content">
                        {!! $post->body !!}
                    </article>

                </div>
            @endforeach
        @else
            <p>Du har ingen kladder.</p>
        @endif
    </div>

    <div id="publiserte-poster" class="row profile-posts container-fluid">
        <div class="post-header-admin">
            <!-- <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6"> -->
            <div>
                <h3>Publiserte poster</h3>
            </div>
            @if(count($published) > 0)
                <div>
                    <!-- <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6"> -->
                    {!! Form::open(array('url' => '/poster', 'method' => 'POST', 'class' => 'form-horizontal', 'role' => 'form')) !!}
                    {!! Form::select('sorting-published', $sortValues, $orderPublishedBy, array('id' => 'orderPublishedBy')) !!}
                    {!! Form::submit('Sortér') !!}
                    {!! Form::close() !!}
                </div>
            @endif
        </div>
        @if(count($published) > 0)
            @foreach($published as $post)
                <div class="profile-post">

                    <div class="post-header">
                        <div>
                            <h4><a href="{{ url('/' . $post->slug) }}">{{ $post->title }}</a></h4>
                            <div>
                                <a class="btn btn-primary" href="{{ url('edit/' . $post->slug) }}">Endre post</a>
                            </div>
                        </div>
                        <div>
                            <p>{{ $post->created_at->format('d\. M, Y \k\l\. H:i') }}, av {{ $post->author->name }}
                                - <a href="{{ url('/' . $post->slug) }}">kommentarer ({{ count($post->comments) }})</a>
                            </p>
                        </div>
                    </div> <!-- .post-header -->

                    <article class="post-content">
                        {!! $post->body !!}
                    </article>

                </div>
            @endforeach
        @else
            <p>Du har ingen kladder.</p>
        @endif
    </div>

@endsection
