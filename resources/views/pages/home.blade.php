@extends('layout')

@section('content')

    <div class="jumbotron">
        <h1>Project Flyer</h1>

        @if ($signedIn)
            <a class="btn btn-primary" href="flyers/create">Create a Flyer</a>
        @else
            <a class="btn btn-primary" href="register">Create an account</a>
        @endif
    </div>

@stop