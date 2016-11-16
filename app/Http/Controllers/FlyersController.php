<?php

namespace App\Http\Controllers;

use App\Flyer;
use App\Http\Controllers\Traits\AuthorisesUsers;
use App\Http\Requests\FlyerRequest;


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
        //Flyer::create($request->all());
        $flyer = $this->user->publish(
            new Flyer($request->all())
        );
        flash()->success("Success", "Your flyer has been created.");

        return redirect(flyer_path($flyer));
    }

    public function show($zip, $street)
    {
        $flyer = Flyer::locatedAt($zip, $street);

        return view('flyers.show', compact('flyer'));
    }
}