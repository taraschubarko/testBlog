<?php

namespace App\Http\Controllers;

use App\Http\Resources\User\UserMessageResource;
use App\Models\User;
use App\Notifications\UserMessageNotification;
use App\Services\Contracts\ChatServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;

class MessageController extends Controller
{
    public $chatService;

    public function __construct(ChatServiceInterface $chatService)
    {
        $this->chatService = $chatService;
    }

    public function index(Request $request)
    {
        return inertia('User/PageUserMessages', [
            'items' => UserMessageResource::collection($request->user()->notifications()->paginate())
        ]);
    }

    public function store(Request $request)
    {
        $user = User::query()->find($request->user_id);
        $user->notify(new UserMessageNotification($request->message, $request->user()->id));
        return redirect()->route('chat.user.messages', $user);
    }

    //Відмітка прочитаного повідомлення
    public function read($id)
    {
        $notification = DatabaseNotification::query()->find($id);
        $notification->markAsRead();
        return redirect()->back();
    }

    public function chat(User $user)
    {
        return inertia('User/PageUserChat', [
            'items' => $this->chatService->chatWith($user),
            'user' => $user,
        ]);
    }
}
