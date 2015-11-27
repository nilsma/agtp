@extends('app')
@section('body-id', 'dashboard')
@section('content')
<section class="dashboard col-lg-12">
    <section class="commands">
        <div>
            <h3>Manage posts</h3>
            <nav id="posts">
                <ul>
                    <li><a href="">My posts</a></li>
                    <li><a href="">Add post</a></li>
                </ul>
            </nav>
        </div>
        <div>
            <h3>Manage documents</h3>
            <nav id="documents">
                <ul>
                    <li><a href="">My documents</a></li>
                    <li><a href="">Upload document</a></li>
                </ul>
            </nav>
        </div>
    </section>
</section>
@endsection