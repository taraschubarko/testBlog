<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Geo;
use App\Models\Role;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __invoke()
    {
        return inertia('Admin/PageAdminIndex');
    }

    public function getCountries()
    {
        $countries = Geo::query()->groupBy('country')->get('country');
        return $countries;
    }

    public function getCities($country)
    {
        $cities = Geo::query()->where('country', $country)
            ->groupBy('city')
            ->get('city');
        return $cities;
    }

    public function getRoles()
    {
        $roles = Role::query()->get(['id', 'name']);
        return $roles;
    }

    public function getStatus()
    {
        return config('user.status');
    }
}
