<!DOCTYPE html>
@section('title', 'Austegardstoppen')
@include('partials/head')
<body id="@yield('body-id')">
<div id="outer-container" class="container">
    @include('partials/header')
    <div id="main-container" class="row">
        @if(\Session::has('alert-message'))
            <div class="{!! \Session::get('alert-type') !!}">
                <p>{!! \Session::get('alert-message') !!}</p>
            </div>
        @endif
        @yield('content')
    </div>
    @include('partials/footer')
</div>
</body>
</html>
