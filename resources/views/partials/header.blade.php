<header class="row">
    <div class="col-lg-12">
        @if(!Auth::check())
            <div id="login-register">
                <ul>
                    <li><a href="/logg-inn">Logg inn</a></li>
                    <li><a href="/registrer">Registrer</a></li>
                </ul>
            </div>
        @else
            <div id="authed" class="col-lg-12">
                <p>Innlogget som: <a href="/dashboard">{{ $username }}</a></p>
            </div>
            <div id="member-nav" class="col-lg-12">
                <nav>
                    <ul>
                        <li><a href="/dashboard">Min profil</a></li>
                        <li><a href="/logout">Logg ut</a></li>
                    </ul>
                </nav>
            </div>
        @endif
        <div id="brand">
            <div>
                <h1><a href="/">Austegardstoppen</a></h1>
            </div>
            <div>
                @include('partials/navigation')
            </div>
        </div> <!-- end #brand -->
    </div>
    <img alt="header scenic" src="/images/header_1024.png"/>
</header>
