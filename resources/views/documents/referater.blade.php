@extends('app')
@section('body-id', 'referater')
@section('content')
    <div id="dokumenter" class="col-lg-12">
        <h2>Styrereferater</h2>
        <section class="referater">
            <section class="til_godkjenning">
                <h3>Referater til godkjenning</h3>
                @if(count($til_godkjenning) > 0)
                    <ul>
                        @foreach($til_godkjenning as $ref)
                            <li><a href="{{ URL::to('/uploads/referater/' . $ref->filename) }}">{{ $ref->title }}</a>
                                @if(isset($currentUser) && $currentUser->role == 'admin')
                                    - <a class="btn btn-primary" href="/dokumenter/godkjenn/{{ $ref->id }}">Godkjenn</a>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p>Der er ingen referater til godkjenning for tiden.</p>
                @endif
            </section>
            <section class="godkjente">
                <h3>Godkjente referater</h3>
                @if(count($godkjente) > 0)
                    <ul>
                        @foreach($godkjente as $ref)
                            <li><a href="{{ URL::to('/uploads/referater/' . $ref->filename) }}">{{ $ref->title }}</a></li>
                        @endforeach
                    </ul>
                @else
                    <p>Der er ingen godkjente referater enda.</p>
                @endif
            </section>
        </section>
    </div>
@endsection