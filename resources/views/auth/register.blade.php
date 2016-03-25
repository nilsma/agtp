@extends('app')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <p>
                Det er kun betalende medlemmer i velforeningen som blir innvilget medlemskap på austegardstoppen.no
            </p>
            <p>
                For å bli medlem må du fylle ut skjemaet nedenfor, hvorpå du vil motta en epost med en verifiseringslenke som du må aktivisere for å fullføre registreringen.
                Dersom du angir en epostadresse som allerede ligger i våre registre vil du motta en epost for aktivisering umiddelbart,
                i motsatt fall kan det ta litt tid fordi vi må godkjenne medlemskapet manuelt først.
                Send en epost til leder&#64;austegardstoppen.no om du synes det
                tar for lang tid.
            </p>
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Registrer</div>
                    <div class="panel-body">

                        {!! Form::open(array('url' => '/registrer', 'method' => 'POST', 'class' => 'form-horizontal', 'role' => 'form')) !!}

                        <div class="form-group">
                            {!! Form::label('name', 'Navn', array('class' => 'col-md-4 control-label')) !!}
                            <div class="col-md-6">
                                {!! Form::text('name', old('name'), array('required', 'class' => 'form-control', 'placeholder' => 'Brukernavn')) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            {!! Form::label('email', 'Email', array('class' => 'col-md-4 control-label')) !!}
                            <div class="col-md-6">
                                {!! Form::email('email', old('email'), array('required', 'class' => 'form-control', 'placeholder' => 'Epostadresse')) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            {!! Form::label('password', 'Passord', array('class' => 'col-md-4 control-label')) !!}
                            <div class="col-md-6">
                                {!! Form::password('password', array('required', 'class' => 'form-control', 'placeholder' => 'Passord')) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            {!! Form::label('confirm', 'Bekreft passord', array('class' => 'col-md-4 control-label', 'name' => 'password_confirmation')) !!}
                            <div class="col-md-6">
                                {!! Form::password('password_confirmation', array('required', 'class' => 'form-control', 'placeholder' => 'Bekreft passord')) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                {!! Form::submit('Registrer', array('class' => 'btn btn-success')) !!}
                                <a href="{{ URL::previous() }}" class="btn btn-primary">Tilbake</a>
                            </div>
                        </div>

                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection