@extends('app')
@section('content')
    @if(isset($message))
    <div>
        {{ $message }}
    </div>
    @endif

    @if(\Session::has('message'))
        <div class="alert alert-success">
            <p>{!! \Session::get('message') !!}</p>
        </div>
    @endif

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

    <div class="form-group">
        {!! Form::submit('Last opp',
          array('class'=>'btn btn-primary')) !!}
    </div>

    {!! Form::close() !!}
@endsection