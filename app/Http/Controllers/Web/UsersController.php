<?php

namespace App\Http\Controllers\Web;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    public function users()
    {
        return view('dashboard.users.index');
    }

    public function edit(User $user)
    {
        return view(view: 'dashboard.users.edit')->with([
            'user' => $user
        ]);
    }
}
