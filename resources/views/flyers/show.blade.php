@extends('layout')

@section('content')

    <div class="row">
        <div class="col-md-4">
            <h1>{{ $flyer->street }}</h1>
            <h3>{{ $flyer->city }}</h3>
            <h2>{{ $flyer->price }}</h2>

            <hr>

            <div class="description">
                {!! nl2br($flyer->description) !!}
            </div>
        </div>

        <div class="col-md-8 gallery">
            @foreach ($flyer->photos->chunk(4) as $photoSet)
                <div class="row">
                    @foreach ($photoSet as $photo)
                        <div class="col-md-3 gallery__image">

                            <!-- Delete image form -->
                            <form method="post" action="/photos/{{ $photo->id }}" class="delete-thumbnail hover-fade">
                                {{ csrf_field() }}
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" title="Delete image">X</button>
                            </form>

                            <!-- Thumbnails -->
                            <a href="/{{ $photo->path }}" data-lity>
                                <img src="/{{ $photo->thumbnail_path }}">
                            </a>
                        </div>
                    @endforeach
                </div>
            @endforeach

            @if ($user && $user->owns($flyer))
                <hr>
                <form id="addPhotosForm"
                      action="{{ route('store_photo_path', [$flyer->zip, $flyer->street]) }}"
                      method="POST"
                      class="dropzone"
                >
                    {{ csrf_field() }}
                </form>
            @endif
        </div>
    </div>

@stop

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/dropzone.css">
@stop

@section('scripts.footer')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/dropzone.js"></script>
    <script>
        Dropzone.options.addPhotosForm = {
            paramName: 'photo',
            maxFileSize: 3,
            acceptedFiles: '.jpg, .jpeg, .png, .bmp'
        }
    </script>
@stop