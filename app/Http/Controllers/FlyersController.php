<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\AuthorisesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\UploadedFile;
Use App\Http\Requests\FlyerRequest;
Use App\Photo;
Use App\Flyer;


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

    public function addPhoto($zip, $street, Request $request)
    {
        $this->validate($request, [
            'photo' => 'required|mimes:jpg,jpeg,png,bmp'
        ]);

        if (! $this->userCreatedFlyer($request)) {
            return $this->unauthorised($request);
        }

        $photo = $this->makePhoto($request->file('photo'));

        Flyer::locatedAt($zip, $street)->addPhoto($photo);

        return 'Photo uploaded successfully.';
    }

    protected function makePhoto(UploadedFile $file)
    {
        return $photo = Photo::named($file->getClientOriginalName())
            ->move($file);
    }

}
