<head>
    {!!HTML::style('css/style.css')!!}
    {!!HTML::style('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css')!!}
    {!! HTML::style('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js') !!}
    {!! HTML::style('https://fonts.googleapis.com/css?family=Lato:100') !!}
    {!! HTML::script('js/jquery.min.js') !!}
    {!! HTML::script('js/g_cal.js') !!}

    <style type="text/css">
        #eventlist { list-style:none; }
        #eventlist li { list-style:none; padding:3px; border-bottom:2px solid #eee;}
        .eventtitle { font-weight:bold; }
    </style>

    <script type="text/javascript">
        jQuery(function ($) {
            $('#eventlist').gCalReader({
                calendarId:'2gmna9efup7a0nr0l9kdploc10@group.calendar.google.com',
                apiKey:'AIzaSyAVhU0GdCZQidylxz7whIln82rWtZ4cIDQ',
                sortDescending: false
            });
        });
    </script>

    <title>@yield('title')</title>
</head>
