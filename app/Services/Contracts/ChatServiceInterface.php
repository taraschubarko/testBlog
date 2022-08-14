<?php

namespace App\Services\Contracts;

use App\Models\User;

interface ChatServiceInterface
{
    public function chatWith(User $user): object;
}
