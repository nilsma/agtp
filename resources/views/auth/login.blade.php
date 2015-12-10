@extends('app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Logg inn</div>
                    <div class="panel-body">

                        {!! Form::open(array('url' => '/auth/login', 'method' => 'POST', 'role' => 'form', 'class' => 'form-horizontal')) !!}

                        <div class="form-group">
                            {!! Form::label('email', 'Email', array('class' => 'col-md-4 control-label')) !!}
                            <div class="col-md-6">
                                {!! Form::email('email', old('email'), array('class' => 'form-control', 'placeholder' => 'Epostadresse')) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            {!! Form::label('password', 'Passord', array('class' => 'col-md-4 control-label')) !!}
                            <div class="col-md-6">
                                {!! Form::password('password', array('class' => 'form-control', 'placeholder' => 'Passord')) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                {!! Form::submit('Logg inn', array('class' => 'btn btn-success')) !!}
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