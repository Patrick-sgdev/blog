<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    protected $user = null;

    public function __construct(Request $request)
    {
        $this->user = auth()->user();
    }

    public function users()
    {
        if (!hasRole('administrator', $this->user)) {
            return response()->json([
                'message' => trans('You do not have permission to perform this action.'),
                'status' => 'error',
                'data' => [],
                'type' => 'unauthorized'
            ], 401);
        }

        $data = User::orderBy('name')->with('roles')->paginate(10);

        return response()->json([
            'message' => '',
            'status' => 'success',
            'data' => $data,
            'pagination' => [
                'current_page' => $data->currentPage(),
                'last_page' => $data->lastPage(),
                'per_page' => $data->perPage(),
                'total' => $data->total(),
                'next_page_url' => $data->nextPageUrl(),
                'prev_page_url' => $data->previousPageUrl(),
            ],
            'type' => '',
        ], 200);
    }

    public function usersTrashed()
    {
        if (!hasRole('administrator', $this->user)) {
            return response()->json([
                'message' => trans('You do not have permission to perform this action.'),
                'status' => 'error',
                'data' => [],
                'type' => 'unauthorized'
            ], 401);
        }

        $data = User::onlyTrashed()->orderBy('name')->with('roles')->paginate(10);

        return response()->json([
            'message' => '',
            'status' => 'success',
            'data' => $data,
            'pagination' => [
                'current_page' => $data->currentPage(),
                'last_page' => $data->lastPage(),
                'per_page' => $data->perPage(),
                'total' => $data->total(),
                'next_page_url' => $data->nextPageUrl(),
                'prev_page_url' => $data->previousPageUrl(),
            ],
            'type' => '',
        ], 200);
    }

    public function user($id)
    {
        if (!hasRole('administrator', $this->user)) {
            return response()->json([
                'message' => trans('You do not have permission to perform this action.'),
                'status' => 'error',
                'data' => [],
                'type' => 'unauthorized'
            ], 401);
        }

        $data = User::where('id', $id)->first();

        return response()->json([
            'message' => '',
            'status' => 'success',
            'data' => $data,
            'type' => '',
        ], 200);
    }

    public function store(Request $request)
    {
        
    }

    public function update(User $user, Request $request)
    {

    }

    public function trash(User $user)
    {
        if(hasRole('administrator', $this->user)) {
            $user->delete();
            return response()->json([
                'message' => trans('User successfully removed but it still can be restored.'),
                'status' => 'error',
                'data' => [],
                'type' => ''
            ]);
        }

        return response()->json([
            'message' => trans('You do not have permission to perform this action.'),
            'status' => 'error',
            'data' => [],
            'type' => 'unauthorized'
        ], 401);
    }

    public function restore(User $user)
    {
        if(hasRole('administrator', $this->user)) {
            $user->restore();
            return response()->json([
                'message' => trans('User was restored.'),
                'status' => 'error',
                'data' => $user,
                'type' => ''
            ]);
        }

        return response()->json([
            'message' => trans('You do not have permission to perform this action.'),
            'status' => 'error',
            'data' => [],
            'type' => 'unauthorized'
        ], 401);
    }

    public function delete(User $user)
    {
        if(hasRole('administrator', $this->user)) {
            $user->forceDelete();
            return response()->json([
                'message' => trans('User was permanently removed.'),
                'status' => 'error',
                'data' => [],
                'type' => ''
            ]);
        }

        return response()->json([
            'message' => trans('You do not have permission to perform this action.'),
            'status' => 'error',
            'data' => [],
            'type' => 'unauthorized'
        ], 401);
    }
}
