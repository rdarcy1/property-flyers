@extends('layout')

@section('content')
    <h1>Selling your home?</h1>

    <hr>



    <div class="row">
        <form method="POST" action="/flyers" enctype="multipart/form-data" class="col-md-6">

            @include('flyers.list_errors')
            @include('flyers.form')

        </form>
    </div>
@stop