<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;

class SignUpController extends Controller
{
    //
    public function create()
    {
        return inertia('Public/PageSignUp');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'birthday' => 'required|date',
            'gender' => 'required|integer',
            'country' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'password' => ['required', 'min:8', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::query()->create($data);
        $userRole = Role::query()->where('slug', 'user')->first();
        $user->roles()->attach($userRole);

        auth()->login($user);

        return redirect(RouteServiceProvider::HOME);
    }

}
