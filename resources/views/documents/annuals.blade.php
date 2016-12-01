@extends('app')
@section('body-id', 'dokumenter')
@section('content')
    <div id="ovrige-dokumenter" class="col-lg-12">
        <h2>Årsmøter</h2>
        <h3>Ordinært årsmøte 2016</h3>
        <ul>
            <li><a href="{{ URL::to('/dokumenter/arsmoter') }}">Protokoll</a></li>
            <li><a href="{{ URL::to('/dokumenter/arsmoter') }}">Referat</a></li>
            <li><a href="{{ URL::to('/dokumenter/arsmoter') }}">Budsjett</a></li>
            <li><a href="{{ URL::to('/dokumenter/arsmoter') }}">Regnskap</a></li>
        </ul>
    </div>
@endsection