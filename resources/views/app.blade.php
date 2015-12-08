<!DOCTYPE html>
@section('title', 'Austegardstoppen')
@include('partials/head')
<body id="@yield('body-id')">
<div id="outer-container" class="container">
    @include('partials/header')
    <div id="main-container" class="row">

        <div id="error-reporting" class="col-lg-12">
            @if(\Session::has('alert-message'))
                <div class="{!! \Session::get('alert-type') !!}">
                    <p>{!! \Session::get('alert-message') !!}</p>
                </div>
            @endif

            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif
        </div>

        @yield('content')
    </div>
    @include('partials/footer')
</div>
</body>
</html>
