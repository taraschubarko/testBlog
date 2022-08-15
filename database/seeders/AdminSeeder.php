<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminRole = Role::query()->where('slug', 'admin')->first();
        $modRole = Role::query()->where('slug', 'moderator')->first();


        User::factory(1)->create([
            'name' => 'Админ',
            'email' => 'admin@admin.com',
            'password' => 1234567890,
        ])->map(function ($user) use ($adminRole, $modRole){
            $user->roles()->attach($adminRole);
        });

        User::factory(1)->create([
            'name' => 'Модератор',
            'email' => 'moderator@moderator.com',
            'password' => 1234567890,
        ])->map(function ($user) use ($adminRole, $modRole){
            $user->roles()->attach($modRole);
        });
    }
}
