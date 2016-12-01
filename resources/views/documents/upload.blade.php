@extends('app')
@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Last opp</div>
                    <div class="panel-body">

                        {!! Form::open(array('route' => 'upload', 'files' => true)) !!}

                        <div class="form-group">
                            {!! Form::label('Document Title') !!}
                            {!! Form::text('title', null,
                                array('required',
                                      'class'=>'form-control',
                                      'placeholder'=>'Document title')) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::select('document_type', [
                            'skriv' => 'Generelt Skriv',
                             'godkjent' => 'Godkjent referat',
                              'til_godkjenning' => 'Referat til godkjenning'
                            ]) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('Choose a File') !!}
                            {!! Form::file('file') !!}
                        </div>

                        <div class="form-group form-nav">
                            {!! Form::submit('Last opp', array('class' => 'btn btn-success')) !!}
                            <a class="btn btn-danger" href="/admin/dashboard">Avbryt</a>
                        </div>

                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection