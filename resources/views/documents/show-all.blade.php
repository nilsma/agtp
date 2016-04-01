@extends('app')
@section('content')
    <div id="godkjente" class="col-lg-12">
        <h3>Godkjente referater</h3>
        @if(count($godkjente) > 0)
            @foreach($godkjente as $ref)
                <div class="referat">
                    <h4>{{ $ref->title }} <span>(<a href="{{ url('uploads/referater/godkjente/' . $ref->filename) }}">{{ $ref->filename }}</a>)</span></h4>
                    <p>
                        Uploaded at: {{ $ref->created_at->format('M d, Y \a\t h:i a') }}
                        - by {{ $ref->owner->name }}
                    </p>
                    <div>
                        <a class="btn btn-danger" href="{{ '/protocols/delete/' . $ref->id }}">Slett referat</a>
                        <a class="btn btn-warning" href="{{ '/protocols/toggle/' . $ref->id }}">Fjern godkjenning</a>
                    </div>
                </div>
            @endforeach
        @else
            <div>
                <p>Der er ingen godkjente referater enda!</p>
            </div>
        @endif
    </div>
    <div id="til_godkjenning" class="col-lg-12">
        <h3>Referater til godkjenning</h3>
        @if(count($til_godkjenning) > 0)
            @foreach($til_godkjenning as $ref)
                <div class="referat">
                    <h4>{{ $ref->title }} <span>(<a href="{{ url('uploads/referater/til_godkjenning/' . $ref->filename) }}">{{ $ref->filename }}</a>)</span></h4>
                    <p>
                        Uploaded at: {{ $ref->created_at->format('M d, Y \a\t h:i a') }}
                        - by {{ $ref->owner->name }}
                    </p>
                    <div>
                        <a class="btn btn-danger" href="{{ '/protocols/delete/' . $ref->id }}">Slett referat</a>
                        <a class="btn btn-success" href="{{ '/protocols/toggle/' . $ref->id }}">Godkjenn referat</a>
                    </div>
                </div>
            @endforeach
        @else
            <div>
                <p>Der er ingen referater til godkjenning enda!</p>
            </div>
        @endif
    </div>
@endsection
