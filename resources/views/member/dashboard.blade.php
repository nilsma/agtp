@extends('app')
@section('body-id', 'dashboard')
@section('content')
<section class="dashboard col-lg-12">
    <section class="commands">
        <div>
            <h3>Behandle poster</h3>
            <nav id="posts">
                <ul>
                    <li><a href="/mine-poster">Mine poster</a></li>
                    <li><a href="/ny-post">Lag ny post</a></li>
                </ul>
            </nav>
        </div>
        <div>
            <h3>Behandle dokumenter</h3>
            <nav id="documents">
                <ul>
                    <li><a href="">Mine dokumenter</a></li>
                    <li><a href="">Last opp dokument</a></li>
                </ul>
            </nav>
        </div>
        <div>
            <h3>Innstillinger</h3>
            <nav id="settings">
                <ul>
                    <li><a href="">Endre profil</a></li>
                    <li><a href="">Endre passord</a></li>
                    <li><a href="">Melde på/av epostliste</a></li>
                </ul>
            </nav>
        </div>
    </section>
</section>
@endsection