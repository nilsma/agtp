@extends('app')
@section('body-id', 'dokumenter')
@section('content')
    <div id="dokumenter-linker" class="col-lg-12">
        <a href="/dokumenter/styrereferater" class="btn btn-default col-lg-4">Styrereferater</a>
        <a href="/dokumenter/arsmoter" class="btn btn-default col-lg-4">Årsmøter</a>
        <a href="/dokumenter/ovrige" class="btn btn-default col-lg-4">Øvrige dokumenter</a>
    </div>
@endsection