<?php

namespace App\Http\Responses;

use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{

    public function toResponse($request)
    {
        $route  = config('fortify.home');

        if (Auth::user()->isAdmin()) {
            $route = config('fortify.admin');
        } 

        if (Auth::user()->isTeacher()) {
            $route = config('fortify.teacher');
        }

        if (Auth::user()->isStudent()) {
            $route = config('fortify.student');
        } 

        return $request->wantsJson()
                    ? response()->json(['two_factor' => false])
                    : redirect()->intended($route);
    }
}