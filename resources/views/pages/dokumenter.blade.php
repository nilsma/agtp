@extends('app')
@section('body-id', 'dokumenter')
@section('content')
    <div id="dokumenter" class="col-lg-12">
        <h2>Dokumenter</h2>
        <section class="referater">
            <section class="til_godkjenning">
                <h3>Referater til godkjenning</h3>
                @if(count($til_godkjenning) > 0)
                    <ul>
                        @foreach($til_godkjenning as $ref)
                            <li><a href="{{ URL::to('/uploads/referater/' . $ref->filename) }}">{{ $ref->title }}</a></li>
                        @endforeach
                    </ul>
                @else
                    <p>Der er ingen referater til gokjenning for tiden.</p>
                @endif
            </section>
            <section class="godkjente">
                <h3>Godkjente referater</h3>
                @if(count($godkjent) > 0)
                    <ul>
                        @foreach($godkjent as $ref)
                            <li><a href="{{ URL::to('/uploads/referater/' . $ref->filename) }}">{{ $ref->title }}</a></li>
                        @endforeach
                    </ul>
                @else
                    <p>Der er ingen godkjente referater enda.</p>
                @endif
            </section>
        </section>
        <section id="orienteringsskriv">
            <h3>Orienteringsskriv</h3>
            @if(count($skriv) > 0)
                <ul>
                    @foreach($skriv as $doc)
                        <li><a href="{{ URL::to('/uploads/skriv/' . $doc->filename ) }}">{{ $doc->title }}</a></li>
                    @endforeach
                </ul>
            @else
                <p>Der er ingen opplastede dokumenter enda.</p>
            @endif
        </section>
    </div>
@endsection