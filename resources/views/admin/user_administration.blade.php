@extends('app')
@section('content')

    <div id="applications" class="row col-lg-12">
        <h3>Søknader</h3>
        @if(count($member_applications) > 0)
            <table>
                <thead>
                <tr>
                    <th>Navn</th>
                    <th>Epost</th>
                    <th>Opprettet</th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($member_applications as $ma)
                    <tr>
                        <td>{{ $ma->name }}</td>
                        <td>{{ $ma->email }}</td>
                        <td>{{ $ma->created_at }}</td>
                        <td><a class="" href="/admin/confirm_member_application/{{$ma->id}}">Bekreft</a></td>
                        <td><a class="" href="/admin/ignore_member_application/{{$ma->id}}">Ignorer</a></td>
                        <td><a class="" href="/admin/block_member_application/{{$ma->id}}">Blokkér</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <p>Der er ingen søknader.</p>
        @endif
    </div> <!-- end #applications -->

    <div id="users" class="row col-lg-12">
        <h3>Aktive brukere</h3>
        @if(count($users) > 0)
            <table>
                <thead>
                <tr>
                    <th>Navn</th>
                    <th>Rolle</th>
                    <th>Epost</th>
                    <th>Opprettet</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td><a>{{ $user->name }}</a></td>
                        <td>{{ $user->role }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->created_at }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <p>Ingen medlemmer.</p>
        @endif
    </div> <!-- end #users -->

@endsection