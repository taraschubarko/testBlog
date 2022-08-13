<?php

namespace App\Http\Controllers;

use App\Http\Resources\User\UserFullResource;
use Illuminate\Http\Request;

class ContactsController extends Controller
{

    public function __invoke(Request $request)
    {
        $contacts = $request->user()->contacts()->count() ?
            UserFullResource::collection($request->user()->contacts) : null;

        return inertia('User/PageUserContacts', [
            'items' => $contacts
        ]);
    }
}
