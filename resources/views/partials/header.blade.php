<header class="row">
    <div class="col-lg-12">
        @if(Auth::check())
            <div id="authed">
                <p>Innlogget som: <a href="/profil">{{ $currentUser->name }}</a></p>
            </div>
            <div id="member-nav">
                <nav class="hidden-xs hidden-sm">
                    <ul>
                        <li><a href="/poster">Poster</a></li>
                        <li>/</li>
                        <li><a href="/ny-post">Lag ny post</a></li>
                        <li>/</li>
                        <li><a href="/dokumenter/last-opp">Last opp dokument</a></li>
                        <li>/</li>
                        <li><a href="/admin/users">Brukere</a></li>
                        <li>/</li>
                        <li><a href="/dashboard">Oversikt</a></li>
                        <li>/</li>
                        <li><a href="/admin/logout">Logg ut</a></li>
                    </ul>
                </nav>
            </div>
        @endif
        <div id="brand">
            <div>
                <h1><a href="/">Austegardstoppen</a></h1>
            </div>
            <div>
                <nav id="main">
                    <div class="hidden-lg hidden-md">
                        @if(Auth::check())
                            <button id="member-menu-btn" type="button" class="btn btn-default" aria-label="Authed Menu">
                                <span class="glyphicon glyphicon-menu-hamburger" aria-hidden="true"></span>
                            </button>
                        @endif
                    </div>
                    <div class="hidden-sm hidden-xs">
                        <ul>
                            @if(Request::is('/'))
                                <li class="active_nav"><a href="/">Hjem</a></li>
                            @else
                                <li><a href="/">Hjem</a></li>
                            @endif

                            <li>/</li>

                            @if(Request::is('vedtekter'))
                                <li class="active_nav"><a href="/vedtekter/">Vedtekter</a></li>
                            @else
                                <li><a href="/vedtekter/">Vedtekter</a></li>
                            @endif

                            <li>/</li>

                            @if(Request::is('ordensregler'))
                                <li class="active_nav"><a href="/ordensregler/">Ordensregler</a></li>
                            @else
                                <li><a href="/ordensregler/">Ordensregler</a></li>
                            @endif

                            <li>/</li>

                            @if(Request::is('dokumenter'))
                                <li class="active_nav"><a href="/dokumenter/">Dokumenter</a></li>
                            @else
                                <li><a href="/dokumenter/">Dokumenter</a></li>
                            @endif
                            <li>/</li>

                            @if(Request::is('om_oss'))
                                <li class="active_nav"><a href="/om_oss/">Om Oss</a></li>
                            @else
                                <li><a href="/om_oss/">Om Oss</a></li>
                            @endif
                        </ul>
                    </div>
                </nav>
            </div>
        </div> <!-- end #brand -->
        <div id="responsive-nav">
            @if(Auth::check())
                <nav id="responsive-nav-authed">
                    @if(Auth::user()->role == 'admin')
                        <ul id="member-menu">
                            <li><a href="/ny-post">Lag ny post</a></li>
                            <li>/</li>
                            <li><a href="/last-opp">Last opp dokument</a></li>
                            <li>/</li>
                            <li><a href="/admin/users">Brukerbehandling</a></li>
                            <li>/</li>
                            <li><a href="/dashboard">Dashboard</a></li>
                            <li>/</li>
                            <li><a href="/admin/logout">Logg ut</a></li>
                        </ul>
                    @elseif(Auth::user()->role == 'author')
                        <ul id="member-menu">
                            <li><a href="/ny-post">Lag ny post</a></li>
                            <li>/</li>
                            <li><a href="/last-opp">Last opp dokument</a></li>
                            <li>/</li>
                            <li><a href="/dashboard">Dashboard</a></li>
                            <li>/</li>
                            <li><a href="/admin/logout">Logg ut</a></li>
                        </ul>
                    @else
                        <ul id="member-menu">
                            <li><a href="/dashboard">Min profil</a></li>
                            <li>/</li>
                            <li><a href="/admin/logout">Logg ut</a></li>
                        </ul>
                    @endif
                </nav>
            @endif
            <nav id="responsive-nav-unauthed" class="hidden-md hidden-lg">
                <ul id="visitor-menu">
                    @if(Request::is('/'))
                        <li class="active_nav"><a href="/">Hjem</a></li>
                    @else
                        <li><a href="/">Hjem</a></li>
                    @endif

                    <li>/</li>

                    @if(Request::is('vedtekter'))
                        <li class="active_nav"><a href="/vedtekter/">Vedtekter</a></li>
                    @else
                        <li><a href="/vedtekter/">Vedtekter</a></li>
                    @endif

                    <li>/</li>

                    @if(Request::is('ordensregler'))
                        <li class="active_nav"><a href="/ordensregler/">Ordensregler</a></li>
                    @else
                        <li><a href="/ordensregler/">Ordensregler</a></li>
                    @endif

                    <li>/</li>

                    @if(Request::is('dokumenter'))
                        <li class="active_nav"><a href="/dokumenter/">Dokumenter</a></li>
                    @else
                        <li><a href="/dokumenter/">Dokumenter</a></li>
                    @endif
                    <li>/</li>

                    @if(Request::is('om_oss'))
                        <li class="active_nav"><a href="/om_oss/">Om Oss</a></li>
                    @else
                        <li><a href="/om_oss/">Om Oss</a></li>
                    @endif

                </ul>
            </nav>
        </div>
    </div>
    <img alt="header scenic" src="/images/header_1024.png"/>
</header>
