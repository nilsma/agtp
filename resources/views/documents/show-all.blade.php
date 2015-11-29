@extends('app')
@section('content')
    <div id="documents" class="col-lg-12">
        @foreach($documents as $doc)
            <div class="document">
                <h3>{{ $doc->title }} <span>(<a href="{{ url('uploads/skriv/' . $doc->filename) }}">{{ $doc->filename }}</a>)</span></h3>
                <p>Uploaded at: {{ $doc->created_at->format('M d, Y \a\t h:i a') }}</p>
                <a class="btn btn-danger" href="">Delete document</a>
            </div>
        @endforeach
    </div>
@endsection
