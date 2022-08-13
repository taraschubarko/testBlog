<?php

namespace App\Listeners;

use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UserMessageListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $notification = $event->notification;
        $user = $event->notifiable;
        $sender = User::query()->find($notification->sender_id);
        if(!$user->contacts()->where('user_id', $sender->id)->first()){
            $user->contacts()->attach($user, ['user_id' => $sender->id]);
        }
        if(!$sender->contacts()->where('user_id', $user->id)->first()){
            $sender->contacts()->attach($sender, ['user_id' => $user->id]);
        }
    }
}
