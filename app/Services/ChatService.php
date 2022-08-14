<?php

namespace App\Services;

use App\Http\Resources\ChatResource;
use App\Models\User;
use App\Services\Contracts\ChatServiceInterface;
use Illuminate\Notifications\DatabaseNotification;

class ChatService implements ChatServiceInterface
{
    public function chatWith(User $user): object
    {
        try {
            $me = auth()->user();

            $toMe = DatabaseNotification::query()
                ->where('type', 'App\Notifications\UserMessageNotification')
                ->where('notifiable_id', $me->id)
                ->where('data->sender_id', $user->id);

            $fromMe = DatabaseNotification::query()
                ->where('type', 'App\Notifications\UserMessageNotification')
                ->where('notifiable_id', $user->id)
                ->where('data->sender_id', $me->id);
            $data = $toMe->union($fromMe)->orderBy('created_at')->get();

            $toMe->get()->each(function ($item){
                $item->markAsRead();
            });

            $items = ChatResource::collection($data);

            return $items;
        } catch (\Exception $exception) {
            abort(500, $exception->getMessage());
        }
    }
}
