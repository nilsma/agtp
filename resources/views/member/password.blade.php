@extends('app')
@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Endre passord</div>
                    <div class="panel-body">

                        {!! Form::open(array('url' => '/endre-passord', 'method' => 'post', 'class' => 'form-horizontal', 'role' => 'form')) !!}

                        <div class="form-group">
                            {!! Form::label('old_password', 'Gammelt passord', array('class' => 'col-md-4 control-label')) !!}
                            <div class="col-md-6">
                                {!! Form::password('old_password', array('required', 'class' => 'form-control', 'placeholder' => 'Gammelt passord')) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            {!! Form::label('new_password', 'Nytt passord', array('class' => 'col-md-4 control-label')) !!}
                            <div class="col-md-6">
                                {!! Form::password('new_password', array('required', 'class' => 'form-control', 'placeholder' => 'Nytt passord')) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            {!! Form::label('repeat_password', 'Gjenta passord', array('class' => 'col-md-4 control-label')) !!}
                            <div class="col-md-6">
                                {!! Form::password('repeat_password', array('required', 'class' => 'form-control', 'placeholder' => 'Nytt passord')) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                {!! Form::submit('Endre passord', array('class' => 'btn btn-success')) !!}
                                <a href="/dashboard" class="btn btn-danger">Avbryt</a>
                            </div>
                        </div>

                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection