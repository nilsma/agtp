@extends('app')
@section('content')
    @if(count($users) > 1)
        <div id="users" class="col-lg-12">
            @foreach($users as $user)
                <div class="user">
                    <h3>{{ $user->name }}</h3>
                    <p>{{ $user->email }} (<span>{{ $user->role }}</span>) <a class="btn btn-primary" href="/admin/user_edit/{{$user->id}}">edit</a></p>
                </div>
            @endforeach
        </div>
    @endif
    <div class="col-lg-12">
        <a class="btn btn-primary" href="/dashboard">Tilbake</a>
    </div>
@endsection