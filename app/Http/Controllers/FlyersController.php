<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\AuthorisesUsers;
use App\Http\Requests\AddPhotoRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\UploadedFile;
use App\Http\Requests\FlyerRequest;
use App\Photo;
use App\Flyer;


class FlyersController extends Controller
{
    use AuthorisesUsers;

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['show']]);

        parent::__construct();
    }

    public function create()
    {
        return view('flyers.create');
    }

    public function store(FlyerRequest $request)
    {
        Flyer::create($request->all());
        flash()->success("Success", "Your flyer has been created.");

        return redirect()->back();
    }

    public function show($zip, $street)
    {
        $flyer = Flyer::locatedAt($zip, $street);

        return view('flyers.show', compact('flyer'));
    }

    public function addPhoto($zip, $street, AddPhotoRequest $request)
    {
        $photo = Photo::fromFile($request->file('photo'));

        Flyer::locatedAt($zip, $street)->addPhoto($photo);

        return 'Photo uploaded successfully.';
    }
}