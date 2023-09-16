<?php

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

/**
 * @return string
 */
function serverErrorMessage()
{
    return 'Something went wrong, internal server error.';
}

function student()
{
    return Auth::user()->student;
}

function teacher()
{
    return Auth::user()->teacher;
}

function logError($e)
{
    $env = config('app.env');
    Log::error("*Error:* `{$e->getMessage()}` \n *File:* {$e->getFile()} at line {$e->getLine()}. \n *Environment:* {$env}");
}

function customCssFilePath()
{
    return app()->isProduction() 
        ? asset('public/custom/css/style.css')
        : asset('custom/css/style.css');
}

function parseDate($date)
{
    return Carbon::parse($date);
}