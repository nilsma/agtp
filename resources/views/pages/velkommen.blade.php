@extends('app')
@section('body-id', 'velkommen')
@section('content')
    <div id="posts" class="col-lg-7">
        @include('partials/posts')
    </div>
    <div id="side-content" class="col-lg-5 row">
        <h2>Hva skjer</h2>
        <ul id="eventlist" class="col-lg-12">
        </ul>
    </div>
@endsection