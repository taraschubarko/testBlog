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
            //Вибираємо повідомлення мені
            $toMe = DatabaseNotification::query()
                ->where('type', 'App\Notifications\UserMessageNotification')
                ->where('notifiable_id', $me->id)
                ->where('data->sender_id', $user->id);
            //Аналогічно повідомлення від мене
            $fromMe = DatabaseNotification::query()
                ->where('type', 'App\Notifications\UserMessageNotification')
                ->where('notifiable_id', $user->id)
                ->where('data->sender_id', $me->id);
            //Поєднуємо запит
            $data = $toMe->union($fromMe)->orderBy('created_at')->get();
            //Відвічаємо всі повідомлення мені прочитаними, так як ми відразу будемо на сторінці чату
            $toMe->get()->each(function ($item){
                $item->markAsRead();
            });
            //Формуємо результат через ресурс
            $items = ChatResource::collection($data);

            return $items;
        } catch (\Exception $exception) {
            abort(500, $exception->getMessage());
        }
    }
}
