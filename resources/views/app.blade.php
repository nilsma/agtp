<!DOCTYPE html>
@section('title', 'Austegardstoppen')
@include('partials/head')
<body id="@yield('body-id')">
<div id="outer-container" class="container">
    @if(Auth::check())
        @include('admin.admin-top')
    @else
        <section id="admin-profile"></section>
    @endif
    @include('partials/header')
    <div id="main-container" class="container">
        @yield('content')
    </div>
    @include('partials/footer')
</div>
</body>
</html>
