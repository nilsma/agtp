@extends('app')
@section('body-id', 'dokumenter')
@section('content')
    <div id="ovrige-dokumenter" class="col-lg-12">
        <h2>Årsmøter</h2>
        <h3>Ordinært årsmøte 2016</h3>
        <ul>
            <li><a href="{{ URL::to('/uploads/arsmoter/2016/#') }}">Protokoll</a></li>
            <li><a href="{{ URL::to('/uploads/arsmoter/2016/#') }}">Referat</a></li>
            <li><a href="{{ URL::to('/uploads/arsmoter/2016/#') }}">Budsjett</a></li>
            <li><a href="{{ URL::to('/uploads/arsmoter/2016/#') }}">Regnskap</a></li>
        </ul>
    </div>
@endsection