@extends('app')
@section('content')
    <div id="documents" class="col-lg-12">
        <ul>
            @foreach($documents as $doc)

            @endforeach
        </ul>
    </div>
@endsection