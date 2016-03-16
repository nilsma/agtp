<nav id="main">
    <div class="hidden-lg hidden-md">
        @if(Auth::check())
        <button id="member-menu-btn" type="button" class="btn btn-default" aria-label="Authed Menu">
            <span class="glyphicon glyphicon-th-large" aria-hidden="true"></span>
        </button>
        @endif
        <button id="visitor-menu-btn" type="button" class="btn btn-default" aria-label="Navigation Menu">
            <span class="glyphicon glyphicon-menu-hamburger" aria-hidden="true"></span>
        </button>
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
