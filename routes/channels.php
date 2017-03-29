<?php

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

Broadcast::channel('App.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('broadcastmessage', function ($user) {
    return (int) $user->id === 1;
});

Broadcast::channel('activity.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('support.{id}', function ($user, $id) {
    //if ($user->canJoinRoom($roomId)) {
    return ['id' => $user->id, 'name' => $user->name];
    //}
});