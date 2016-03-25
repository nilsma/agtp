@extends('app')
@section('content')

    <div id="users" class="col-lg-12">
        <h3>Søknader</h3>
        @if(count($member_applications) > 0)
            @foreach($member_applications as $ma)
                <div class="member_application">
                    <ul>
                        <li>Navn: <span class="username">{{ $ma->name }}</span></li>
                        <li>Epost: <span class="email">{{ $ma->email }}</span></li>
                    </ul>
                    <a class="" href="/admin/member_application_confirm/{{$ma->id}}">bekreft</a>
                    <a class="" href="/admin/member_application_ignore/{{$ma->id}}">ignorer</a>
                </div>
            @endforeach
        @else
            <div class="user">
                <p>Ingen søknader.</p>
            </div>
        @endif
    </div>

    <div id="users" class="col-lg-12">
        <h3>Aktive brukere</h3>
        @if(count($users) > 0)
            @foreach($users as $user)
                <div class="user">
                    <p><span class="username">{{ $user->name }}</span> <span class="role">({{ $user->role }})</span> - <span class="email">{{ $user->email }}</span> <a class="" href="/admin/user_edit/{{$user->id}}">endre</a></p>
                </div>
            @endforeach
        @else
            <div class="user">
                <p>Ingen medlemmer.</p>
            </div>
        @endif
    </div>
    <div class="col-lg-12">
        <a class="btn btn-danger" href="/dashboard">Avbryt</a>
    </div>
@endsection