<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SignInController extends Controller
{
    public function create()
    {
        return inertia('Public/PageSignIn');
    }

    public function store(LoginRequest $request)
    {
        //Авторизуємо користувача
        $request->authenticate();
        //Створюємо йому сесію
        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
