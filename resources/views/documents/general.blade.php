@extends('app')
@section('body-id', 'dokumenter')
@section('content')
    <div id="ovrige-dokumenter" class="col-lg-12">
        <h2>Øvrige dokumenter</h2>
        @if(count($documents) > 0)
            <ul>
            @foreach($documents as $document)
                <li><a href="{{ URL::to('/uploads/skriv/' . $document->filename) }}">{{ $document->title }}</a></li>
            @endforeach
            </ul>
        @endif
    </div>
@endsection