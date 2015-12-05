@extends('app')
@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Endre bruker</div>
                    <div class="panel-body">

                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        {!! Form::open(array('url' => '/admin/edit_user', 'method' => 'POST', 'class' => 'form-horizontal', 'role' => 'form')) !!}

                            {!! Form::hidden('user_id', $edit_user->id) !!}

                            <div class="form-group">
                                {!! Form::label('name', 'Navn', array('class' => 'col-md-4 control-label')) !!}
                                <div class="col-md-6">
                                    {!! Form::text('name', $edit_user->name, array('required', 'class' => 'form-control')) !!}
                                </div>
                            </div>

                            <div class="form-group">
                                {!! Form::label('email', 'Epost', array('class' => 'col-md-4 control-label')) !!}
                                <div class="col-md-6">
                                    {!! Form::text('email', $edit_user->email, array('required', 'class' => 'form-control')) !!}
                                </div>
                            </div>

                            <div class="form-group">
                                {!! Form::label('role', 'Rolle', array('class' => 'col-md-4 control-label')) !!}
                                <div class="col-md-6">
                                    {!! Form::select('role', array('subscriber' => 'Subscriber', 'author' => 'Author', 'admin' => 'Admin'), $edit_user->role) !!}
                                </div>
                            </div>

                            <div class="form-group form-nav">
                                <div class="col-md-6 col-md-offset-4">
                                    {!! Form::submit('Lagre bruker', array('class' => 'btn btn-success')) !!}
                                    <a class="btn btn-danger" href="/admin/users">Avbryt</a>
                                </div>
                            </div>

                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection