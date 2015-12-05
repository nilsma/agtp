@extends('app')
@section('content')
<div id="posts" class="col-lg-12">
    @if(count($posts) > 0)
    @foreach($posts as $post)
        <div class="post">
            <div class="post-header">
                <div>
                    <h3>{{ $post->title }}</h3>
                    <div>
                        <a class="btn btn-danger" href="{{ url('delete/' . $post->id) }}">Delete</a>
                        <a class="btn btn-primary" href="{{ url('edit/' . $post->slug) }}">Edit</a>
                    </div>
                </div>
                <div>
                    <p>{{ $post->created_at->format('M d, Y \a\t h:i a') }}</p>
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

