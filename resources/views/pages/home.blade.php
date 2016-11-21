@extends('layout')

@section('content')

    <div class="jumbotron text-center clearfix">
        <h1>Property Flyers</h1>
        <h3>A Laravel application to create and manage real estate flyers.</h3>
        <p class="front-page">Inspired by the <a
                    href="https://laracasts.com/series/build-project-flyer-with-me" target="_blank">Laracasts
                tutorial</a>.</p>

        <hr class="short">

        @if ($signedIn)
            <a class="btn btn-primary" href="flyers/create">Create a Flyer</a>
        @else
            <p class="front-page">In order to create a flyer, please</p>
            <p>
                <a class="btn btn-primary" href="register">Create an account</a>
                or
                <a class="btn btn-primary" href="login">Login</a>
            </p>
        @endif

        <hr>

        <h2>Recent Flyers</h2>
        @if (sizeof($recentFlyers))
            @foreach ($recentFlyers as $flyer)
                @php ($flyer_url = '/' . flyer_path($flyer) )

                <a href="{{ $flyer_url }}">
                    <div class="recent-flyer-row">
                        <div class="col-md-3">

                            @if ($photo = $flyer->photos->first())

                                <img src="/{{ $photo->thumbnail_path }}" class="img-rounded">
                            @endif
                        </div>

                        <div class="col-md-9">
                            <h4>{{ $flyer->street }}</h4>
                            <h3>{{ $flyer->city }}</h3>
                        </div>

                    </div>
                </a>

                @unless ($loop->last)
                    <hr>
                @endunless
            @endforeach

        @else
            <p>No recent flyers to show.</p>
        @endif

    </div>

@stop