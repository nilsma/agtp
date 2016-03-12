<!DOCTYPE html>
@section('title', 'Austegardstoppen')
@include('partials/head')
<body id="@yield('body-id')" class="site">
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
        </div> <!-- end #error-reporting -->

        @yield('content')
        @include('partials/footer')
    </div> <!-- end #main-container -->

</div> <!-- end #outer-container -->
</body>
</html>
