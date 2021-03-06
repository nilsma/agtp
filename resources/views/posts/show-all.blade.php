@extends('app')
@section('content')
    <div id="posts" class="col-lg-12">
        @if(count($posts) > 0)
            @foreach($posts as $post)
                <div class="post">
                    <div class="post-header">
                        <div>
                            @if(!$post->active == 1)
                                <h3 class="post-title">{{ $post->title }} <span>(kladd)</span></h3>
                            @else
                                <h3>{{ $post->title }}</h3>
                            @endif
                            <div>
                                <a class="btn btn-danger" href="{{ url('delete/' . $post->id) }}">Slett</a>
                                <a class="btn btn-primary" href="{{ url('edit/' . $post->slug) }}">Endre</a>
                            </div>
                        </div>
                        <div>
                            <p>
                                {{ $post->created_at->format('M d, Y \a\t h:i a') }}
                                - by {{ $post->author->name }}
                            </p>
                        </div>
                    </div>
                    {!! $post->body !!}
                </div>
            @endforeach
        @else
            <p>Du har ikke laget noen poster enda!</p>
        @endif
    </div>
    <div class="col-lg-12">
        <a class="btn btn-primary" href="/dashboard">Tilbake</a>
    </div>
@endsection
