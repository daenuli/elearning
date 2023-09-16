<?php

use App\Models\SchoolClass;
use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.Models.Student.{id}', function ($student, $id) {
    return (int) $student->id === (int) $id;
});

Broadcast::channel('private-class.{id}', function ($user, $id) {
    return (int) $user->student->class_id === (int) $id;
});

Broadcast::channel('lesson-created-notification', function () {
    return true;
});