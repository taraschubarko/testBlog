<?php

namespace Database\Seeders;

use App\Models\User;
use App\Notifications\UserMessageNotification;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MessagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::find(1);
        $users = User::query()->where('id', '<>', 1)->get();
        $users = $users->pluck('id')->toArray();

        foreach (range(1, 20) as $item){
            $user->notify(new UserMessageNotification(
                fake()->text(),
                fake()->randomElement($users)
            ));
        }
    }
}
