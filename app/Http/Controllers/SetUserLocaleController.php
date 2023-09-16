<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SetUserLocaleController extends Controller
{
    public function update(Request $request)
    {
        if (in_array($request->locale, config('app.locales'))) {
            $user = auth()->user();
            $user->locale = $request->input('locale');
            $user->save();
        }   

        return response()->noContent();
    }
}
