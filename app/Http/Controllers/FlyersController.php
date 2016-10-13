<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
Use App\Http\Requests\FlyerRequest;

Use App\Flyer;


class FlyersController extends Controller
{

    public function index()
    {

    }

    public function create()
    {
        return view('flyers.create');
    }

    public function store(FlyerRequest $request)
    {
        Flyer::create($request->all());

        return redirect()->back();
    }
}
