@if ( !$posts->count() )
    <div id="post-main">
        There is no post till now. Login and write a new post now!!!
    </div>
@else
    @foreach( $posts as $post )
        <div class="post-main">
            <div class="post-options">
                <h3><a href="{{ url('/'.$post->slug) }}">{{ $post->title }}</a>
                    @if(!Auth::guest() && ($post->author_id == Auth::user()->id || Auth::user()->is_admin()))
                        @if($post->active == '1')
                            <button class="btn" style="float: right"><a href="{{ url('edit/'.$post->slug)}}">Edit Post</a></button>
                        @else
                            <button class="btn" style="float: right"><a href="{{ url('edit/'.$post->slug)}}">Edit Draft</a></button>
                        @endif
                    @endif
                </h3>
                <p>{{ $post->created_at->format('M d, Y \a\t h:i a') }}, by {{ $post->author->name }}</p>
            </div>
            <article class="post-content">
                {!! str_limit($post->body, $limit = 1500, $end = '....... <a href='.url("/".$post->slug).'>Read More</a>') !!}
            </article>
        </div>
    @endforeach
    {!! $posts->render() !!}
@endif
