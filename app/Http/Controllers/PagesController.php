<?php

namespace App\Http\Controllers;

use App\Flyer;

class PagesController extends Controller
{
    public function home()
    {
        $recentFlyers = Flyer::orderBy('created_at')->limit(3)->get();

        return view('pages.home', compact('recentFlyers'));
    }
}