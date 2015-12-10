@extends('app')
@section('content')
    @if(count($users) > 1)
        <div id="users" class="col-lg-12">
            @foreach($users as $user)
                <div class="user">
                    <p>{{ $user->name }} <span class="role">({{ $user->role }})</span> - <span class="email">{{ $user->email }}</span> <a class="btn btn-primary" href="/admin/user_edit/{{$user->id}}">Endre</a></p>
                </div>
            @endforeach
        </div>
    @endif
    <div class="col-lg-12">
        <a class="btn btn-primary" href="/dashboard">Tilbake</a>
    </div>
@endsection