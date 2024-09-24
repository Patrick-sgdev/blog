<?php

namespace App\Http\Controllers\Api;

use App\Models\Role;
use App\Models\UserToken;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\CategoryTagResource;

class RoleController extends Controller
{
    protected $user = null;

    public function __construct(Request $request)
    {
        $userToken = UserToken::where('public_token', $request->public_token)->first();

        if ($userToken && Hash::check($request->secret_token, $userToken->secret_token)) {
            $this->user = $userToken->user;
        }
    }

    public function roles()
    {
        if (!hasRole('administrator', $this->user)) {
            return response()->json([
                'message' => trans('You do not have permission to perform this action.'),
                'status' => 'error',
                'data' => [],
                'type' => 'unauthorized'
            ], 401);
        }

        $data = [];

        if (hasRole('administrator', $this->user)) {
            $data = Role::orderBy('name')->select('id', 'name', 'description')->paginate(10);
        }

        return response()->json([
            'message' => '',
            'status' => 'success',
            'data' => CategoryTagResource::collection($data),
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

    public function role($id)
    {
        if (!hasRole('administrator', $this->user)) {
            return response()->json([
                'message' => trans('You do not have permission to perform this action.'),
                'status' => 'error',
                'data' => [],
                'type' => 'unauthorized'
            ], 401);
        }

        $data = [];

        if (hasRole('administrator', $this->user)) {
            $data = Role::where('id', $id)
                ->select('id', 'name', 'description')
                ->first();
        }

        return response()->json([
            'message' => '',
            'status' => 'success',
            'data' => $data,
            'type' => '',
        ], 200);
    }

    public function store(Request $request)
    {
        if (!hasAnyRole(['administrator', 'author'], $this->user)) {
            return response()->json([
                'message' => trans('You do not have permission to perform this action.'),
                'status' => 'error',
                'data' => [],
                'type' => 'unauthorized'
            ], 401);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|min:2|max:255',
            'description' => 'nullable|min:2|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => '',
                'status' => 'error',
                'data' => $validator->messages()->get('*'),
                'type' => 'validation'
            ]);
        }

        try {

            $role = Role::create( [
                'name' => $request->name,
                'description' => $request->description,
            ]);

            return response()->json([
                'message' => trans('Role successfully created.'),
                'status' => 'success',
                'data' => $role,
                'type' => ''
            ]);

        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage(),
                'status' => 'error',
                'data' => [],
                'type' => 'exception'
            ]);
        }
    }

    public function update(Role $role, Request $request)
    {
        if (!hasRole('administrator', $this->user)) {
            return response()->json([
                'message' => trans('You do not have permission to perform this action.'),
                'status' => 'error',
                'data' => [],
                'type' => 'unauthorized'
            ], 401);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|min:2|max:255',
            'description' => 'nullable|min:2|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => '',
                'status' => 'error',
                'data' => $validator->messages()->get('*'),
                'type' => 'validation'
            ]);
        }

        try {

            $role->name = $request->name;
            $role->description = $request->description;
            $role->save();

            return response()->json([
                'message' => trans('Role successfully updated.'),
                'status' => 'success',
                'data' => $role,
                'type' => ''
            ]);

        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage(),
                'status' => 'error',
                'data' => [],
                'type' => 'exception'
            ]);
        }
    }

    public function trash(Role $role)
    {
        if(hasRole('administrator', $this->user)) {
            if(in_array($role->name, ['author', 'administrator'])) {
                return response()->json([
                    'message' => trans('This is a core role of the system and cannot be deleted.'),
                    'status' => 'error',
                    'data' => [],
                    'type' => ''
                ]);
            }

            $role->delete();
            return response()->json([
                'message' => trans('Role successfully removed but it still can be restored.'),
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

    public function restore(Role $role)
    {
        if(hasRole('administrator', $this->user)) {
            if(in_array($role->name, ['author', 'administrator'])) {
                return response()->json([
                    'message' => trans('This is a core role of the system and cannot be deleted.'),
                    'status' => 'error',
                    'data' => [],
                    'type' => ''
                ]);
            }

            $role->restore();
            return response()->json([
                'message' => trans('Role was restored.'),
                'status' => 'error',
                'data' => $role,
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

    public function delete(Role $role)
    {
        if(hasRole('administrator', $this->user)) {
            if(in_array($role->name, ['author', 'administrator'])) {
                return response()->json([
                    'message' => trans('This is a core role of the system and cannot be deleted.'),
                    'status' => 'error',
                    'data' => [],
                    'type' => ''
                ]);
            }

            $role->forceDelete();
            return response()->json([
                'message' => trans('Role was permanently removed.'),
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
