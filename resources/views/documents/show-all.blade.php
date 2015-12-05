@extends('app')
@section('content')
    @if(\Session::has('message'))
        <div class="alert alert-info">
            <p>{!! \Session::get('message') !!}</p>
        </div>
    @endif
    <div id="referater" class="col-lg-12">
        <div id="godkjente">
            <h3>Godkjente referater</h3>
            @if(count($godkjente) > 0)
                @foreach($godkjente as $ref)
                    <div class="referat">
                        <h4>{{ $ref->title }} <span>(<a href="{{ url('uploads/referater/godkjente/' . $ref->filename) }}">{{ $ref->filename }}</a>)</span></h4>
                        <p>Uploaded at: {{ $ref->created_at->format('M d, Y \a\t h:i a') }}</p>
                        <div>
                            <a class="btn btn-danger" href="{{ '/protocols/delete/' . $ref->id }}">Slett referat</a>
                            <a class="btn btn-warning" href="{{ '/protocols/toggle/' . $ref->id }}">Fjern godkjenning</a>
                        </div>
                    </div>
                @endforeach
            @else
                <div>
                    <p>Du har ikke lastet opp noen referater enda.</p>
                </div>
            @endif
        </div>
        <div id="til_godkjenning">
            <h3>Referater til godkjenning</h3>
            @if(count($til_godkjenning) > 0)
                @foreach($til_godkjenning as $ref)
                    <div class="referat">
                        <h4>{{ $ref->title }} <span>(<a href="{{ url('uploads/referater/til_godkjenning/' . $ref->filename) }}">{{ $ref->filename }}</a>)</span></h4>
                        <p>Uploaded at: {{ $ref->created_at->format('M d, Y \a\t h:i a') }}</p>
                        <div>
                            <a class="btn btn-danger" href="{{ '/protocols/delete/' . $ref->id }}">Slett referat</a>
                            <a class="btn btn-success" href="{{ '/protocols/toggle/' . $ref->id }}">Godkjenn referat</a>
                        </div>
                    </div>
                @endforeach
            @else
                <div>
                    <p>Du har ingen referater til godkjenning.</p>
                </div>
            @endif
        </div>
    </div>
    <div id="documents" class="col-lg-12">
        <h3>Mine skriv</h3>
        @if(count($documents) > 0)
            @foreach($documents as $doc)
                <div class="document">
                    <h4>{{ $doc->title }} <span>(<a href="{{ url('uploads/skriv/' . $doc->filename) }}">{{ $doc->filename }}</a>)</span></h4>
                    <p>Uploaded at: {{ $doc->created_at->format('M d, Y \a\t h:i a') }}</p>
                    <div>
                        <a class="btn btn-danger" href="{{ '/documents/delete/' . $doc->id }}">Slett dokument</a>
                    </div>
                </div>
            @endforeach
        @else
            <div>
                <p>Du har ikke lastet opp noen skriv enda.</p>
            </div>
        @endif
    </div>
    <div class="col-lg-12">
        <a class="btn btn-primary" href="/dashboard">Tilbake</a>
    </div>
@endsection
