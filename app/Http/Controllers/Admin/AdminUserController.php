<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\AdminUserEditResource;
use App\Http\Resources\Admin\AdminUsersListResource;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return
     */
    public function index()
    {
        $users = User::query()->orderByDesc('created_at')->paginate();
        $users = $users ? AdminUsersListResource::collection($users) : null;

        return inertia('Admin/PageAdminUsers', [
            'items' => $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return
     */
    public function create()
    {
        return inertia('Admin/PageAdminUserCreate');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'birthday' => 'required',
            'gender' => 'required',
            'country' => 'required',
            'city' => 'required',
            'password' => 'required',
            'roles' => 'required',
            'status' => 'required',
        ]);
        $user = User::query()->create($data);
        //Добавляємо ролі користувачу
        $roles = Role::query()->whereIn('id', $data['roles'])->get();
        $user->roles()->attach($roles);
        return redirect()->route('dashboard.users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param
     * @return
     */
    public function show(User $user)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param
     * @return
     */
    public function edit(User $user)
    {
        return inertia('Admin/PageAdminUserEdit', [
            'item' => AdminUserEditResource::make($user),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  User $user
     * @return
     */
    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'birthday' => 'required',
            'gender' => 'required',
            'country' => 'required',
            'city' => 'required',
            'password' => 'sometimes',
            'roles' => 'required',
            'status' => 'required',
        ]);
        if(is_null($data['password'])){
            unset($data['password']);
        }
        $user->update($data);
        //Видаляємо ролі користувача
        $user->roles()->detach();
        //Добавляємо ролі користувачу
        $roles = Role::query()->whereIn('id', $data['roles'])->get();
        $user->roles()->attach($roles);
        return redirect()->route('dashboard.users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return
     */
    public function destroy(User $user)
    {
        $user->posts()->delete();
        $user->delete();
        return redirect()->back();
    }
}
