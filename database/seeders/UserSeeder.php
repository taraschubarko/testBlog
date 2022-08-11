<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userRole = Role::query()->where('slug', 'user')->first();

        User::factory(10)->create()
            ->map(function ($user) use ($userRole){
            $user->roles()->attach($userRole);
        });
    }
}
