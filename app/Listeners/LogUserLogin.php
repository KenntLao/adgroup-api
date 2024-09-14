<?php

namespace App\Listeners;

use App\Events\UserLoggedIn;
use App\Models\AuditLog;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogUserLogin
{
    public function handle(UserLoggedIn $event)
    {
        $user = $event->user;
        $changes = [
            'email' => $user->email,
            'login_time' => now(),
        ];

        AuditLog::create([
            'event' => 'login',
            'model_type' => get_class($user),
            'model_id' => $user->id,
            'changes' => json_encode($changes),
            'user_id' => $user->id,
        ]);
    }
}
