@extends('app')
@section('content')

    <div id="users" class="">
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