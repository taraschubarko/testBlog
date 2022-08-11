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
            'name' => 'Чубарко Тарас',
            'email' => 'tchubarko@gmail.com',
            'password' => 1234567890,
        ])->map(function ($user) use ($adminRole, $modRole){
            $user->roles()->attach($adminRole);
            $user->roles()->attach($modRole);
        });
    }
}
