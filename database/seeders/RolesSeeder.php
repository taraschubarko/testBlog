<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            'admin' => 'Admin',
            'user' => 'User',
            'moderator' => 'Moderator',
        ];

        foreach ($roles as $k => $role){
            Role::query()->create([
                'name' => $role,
                'slug' => $k,
            ]);
        }
    }
}
