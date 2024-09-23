<?php

namespace App\Http\Controllers\Web;

use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    public function roles()
    {
        return view('dashboard.roles.index');
    }

    public function edit(Role $role)
    {
        return view(view: 'dashboard.roles.edit')->with([
            'role' => $role
        ]);
    }
}
