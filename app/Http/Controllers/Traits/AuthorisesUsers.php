<?php

namespace App\Http\Controllers\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Flyer;

trait AuthorisesUsers
{
    protected function userCreatedFlyer(Request $request)
    {
        return Flyer::where([
            'zip' => $request->zip,
            'street' => $request->street,
            'user_id' => Auth::user()->id
        ])->exists();
    }

    protected function unauthorised(Request $request)
    {
        $message = 'You are not authorised to upload photos here.';

        if ($request->ajax()) {
            return response(['message' => $message], 403);
        }

        flash($message);

        return redirect('/');
    }
}