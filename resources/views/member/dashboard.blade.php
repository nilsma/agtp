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
                            <li><a href="/admin/brukere/oversikt">Brukeroversikt</a></li>
                        </ul>
                    </nav>
                @endif
                @if(Auth::user()->role == 'author' || Auth::user()->role == 'admin')
                    <h3>Behandle poster</h3>
                    <nav id="posts">
                        <ul>
                            <li><a href="/admin/poster/egne">Mine poster</a></li>
                            @if(Auth::user()->role == 'admin')
                                <li><a href="/admin/poster/alle">Alle poster</a></li>
                            @endif
                            <li><a href="/admin/poster/ny">Lag ny post</a></li>
                        </ul>
                    </nav>
                @endif
            </div>
            <div>
                @if(Auth::user()->role == 'author' || Auth::user()->role == 'admin')
                    <h3>Behandle dokumenter</h3>
                    <nav id="documents">
                        <ul>
                            <li><a href="/admin/dokumenter/egne">Mine dokumenter</a></li>
                            @if(Auth::user()->role == 'admin')
                                <li><a href="/admin/dokumenter/alle">Alle dokumenter</a></li>
                            @endif
                            <li><a href="/admin/dokumenter/last-opp">Last opp dokument</a></li>
                        </ul>
                    </nav>
                @endif
            </div>
        </section>
    </section>
@endsection