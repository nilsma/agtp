<header class="row">
    <div class="col-lg-12">
        @if(!Auth::check())
            <div id="login-register" class="col-lg-12">
                <ul>
                    <li><a href="/login">Login</a></li>
                    <li><a href="/admin/register">Register</a></li>
                </ul>
            </div>
        @else
            <div id="authed" class="col-lg-12">
                <p>Logged in as: <a href="">{{ $username }}</a></p>
            </div>
        @endif
        <div class="row">
            <div class="col-lg-4">
                <h1>Austegardstoppen</h1>
            </div>

            <div class="col-lg-8">
                @include('partials/navigation')
            </div>
        </div>
    </div>
    <img alt="header scenic" src="/images/header_1024.png"/>
</header>
