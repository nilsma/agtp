@extends('app')
@section('body-id', 'velkommen')
@section('content')
<div class="col-lg-7">
        <h2>Main content here</h2>
        <article>
            <p>Some paragraphs happening here</p>
        </article>
    </div>
    <div class="col-lg-5">
        <h2>Hva skjer på Austegardstoppen</h2>
        <div>
            <ul id="eventlist">
            </ul>
        </div>
    </div>
@endsection