@extends('app')
@section('body-id', 'dokumenter')
@section('content')
<section class="referater col-lg-12">
    <section class="til_godkjenning">
        <h3>Referater til godkjenning</h3>
        <ul>
            @foreach($til_godkjenning as $ref)
                <li><a href="{{ URL::to('/uploads/referater/til_godkjenning/' . $ref->filename) }}">{{ $ref->title }}</a></li>
            @endforeach
        </ul>
    </section>
    <section class="godkjente">
        <h3>Godkjente referater</h3>
        <ul>
            @foreach($godkjent as $ref)
                <li><a href="{{ URL::to('/uploads/referater/godkjent/' . $ref->filename) }}">{{ $ref->title }}</a></li>
            @endforeach
        </ul>
    </section>
</section>
<section id="orienteringsskriv" class="col-lg-12">
    <h3>Orienteringsskriv</h3>
    <ul>
        @foreach($skriv as $doc)
            <li><a href="{{ URL::to('/uploads/skriv/' . $doc->filename ) }}">{{ $doc->title }}</a></li>
        @endforeach
    </ul>
</section>
@endsection