@extends('app')
@section('body-id', 'dashboard')
@section('content')

    <section class="dashboard col-lg-12">
        <section class="commands">
            <div>
                @if(Auth::user()->role == 'admin')
                    <h3>Behandle brukere</h3>
                    <nav id="users">
                        <ul>
                            <li><a href="/admin/users">Brukeroversikt</a></li>
                        </ul>
                    </nav>
                @endif
                @if(Auth::user()->role == 'author' || Auth::user()->role == 'admin')
                    <h3>Behandle poster</h3>
                    <nav id="posts">
                        <ul>
                            <li><a href="/mine-poster">Mine poster</a></li>
                            <li><a href="/ny-post">Lag ny post</a></li>
                        </ul>
                    </nav>
                @endif
            </div>
            <div>
                @if(Auth::user()->role == 'author' || Auth::user()->role == 'admin')
                    <h3>Behandle dokumenter</h3>
                    <nav id="documents">
                        <ul>
                            <li><a href="/mine-dokumenter">Mine dokumenter</a></li>
                            <li><a href="/last-opp">Last opp dokument</a></li>
                        </ul>
                    </nav>
                @endif
            </div>
            <div>
                <h3>Innstillinger</h3>
                <nav id="settings">
                    <ul>
                        <li><a href="/endre-passord">Endre passord</a></li>
                        <li><a href="/epostlister">Melde på/av epostliste</a></li>
                    </ul>
                </nav>
            </div>
        </section>
    </section>
@endsection