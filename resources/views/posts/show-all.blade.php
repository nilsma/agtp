@extends('app')
@section('content')
<div id="posts" class="col-lg-12">
    @foreach($posts as $post)
        <div class="post">
            <div class="post-header">
                <div>
                    <h3>{{ $post->title }}</h3>
                    <div>
                        <a class="btn btn-primary" href="{{ url('edit/' . $post->slug) }}">Edit post</a>
                    </div>
                </div>
                <div>
                    <p>{{ $post->created_at->format('M d, Y \a\t h:i a') }}</p>
                </div>
            </div>
            {!! $post->body !!}
        </div>
    @endforeach
</div>
@endsection

