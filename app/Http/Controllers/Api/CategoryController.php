<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use App\Models\Category;
use App\Models\UserToken;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\CategoryTagResource;

class CategoryController extends Controller
{
    protected $user = null;

    public function __construct(Request $request)
    {
        $userToken = UserToken::where('public_token', $request->public_token)->first();

        if ($userToken && Hash::check($request->secret_token, $userToken->secret_token)) {
            $this->user = $userToken->user;
        }
    }

    public function categories()
    {
        if (!hasAnyRole(['administrator', 'author'], $this->user)) {
            return response()->json([
                'message' => trans('You do not have permission to perform this action.'),
                'status' => 'error',
                'data' => [],
                'type' => 'unauthorized'
            ], 401);
        }

        $data = [];

        if (hasRole('administrator', $this->user)) {
            $data = Category::orderBy('name')->select('id', 'name', 'description')->paginate(10);
        }

        if (hasRole('author', $this->user) && !hasRole('administrator', $this->user)) {
            $data = Category::orderBy('name')->where(function ($query) {
                $query->whereNull('user_id')
                    ->orWhere('user_id', $this->user->id);
            })->paginate(10);
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

    public function categoriesTrashed()
    {
        if (!hasAnyRole(['administrator', 'author'], $this->user)) {
            return response()->json([
                'message' => trans('You do not have permission to perform this action.'),
                'status' => 'error',
                'data' => [],
                'type' => 'unauthorized'
            ], 401);
        }

        $data = [];

        if (hasRole('administrator', $this->user)) {
            $data = Category::onlyTrashed()->orderBy('name')->select('id', 'name', 'description')->paginate(10);
        }

        if (hasRole('author', $this->user) && !hasRole('administrator', $this->user)) {
            $data = Category::onlyTrashed()->orderBy('name')->where(function ($query) {
                $query->whereNull('user_id')
                    ->orWhere('user_id', $this->user->id);
            })->paginate(10);
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

    public function category($id)
    {
        if (!hasAnyRole(['administrator', 'author'], $this->user)) {
            return response()->json([
                'message' => trans('You do not have permission to perform this action.'),
                'status' => 'error',
                'data' => [],
                'type' => 'unauthorized'
            ], 401);
        }

        $data = [];

        if (hasRole('administrator', $this->user)) {
            $data = Category::where('id', $id)
                ->select('id', 'name', 'description')
                ->first();
        }

        if (hasRole('author', $this->user)) {
            $data = Category::where('id', $id)
                ->where('user_id', $this->user->id)
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

            $category = Category::create( [
                'user_id' => $this->user->id,
                'name' => $request->name,
                'description' => $request->description,
            ]);

            return response()->json([
                'message' => trans('Category successfully created.'),
                'status' => 'success',
                'data' => $category,
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

    public function update(Category $category, Request $request)
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

            $category->name = $request->name;
            $category->description = $request->description;
            $category->save();

            return response()->json([
                'message' => trans('Category successfully updated.'),
                'status' => 'success',
                'data' => $category,
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

    public function trash(Category $category)
    {
        if(hasRole('administrator', $this->user)) {
            $category->delete();
            return response()->json([
                'message' => trans('Category successfully removed but it still can be restored.'),
                'status' => 'error',
                'data' => [],
                'type' => ''
            ]);
        }

        if(hasRole('author', $this->user) && $category->user_id == $this->user->id) {
            $category->delete();
            return response()->json([
                'message' => trans('Category successfully removed but it still can be restored.'),
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

    public function restore(Category $category)
    {
        if(hasRole('administrator', $this->user)) {
            $category->restore();
            return response()->json([
                'message' => trans('Category was restored.'),
                'status' => 'error',
                'data' => $category,
                'type' => ''
            ]);
        }

        if(hasRole('author', $this->user) && $this->user->id == $category->user_id) {
            $category->restore();
            return response()->json([
                'message' => trans('Category was restored.'),
                'status' => 'error',
                'data' => $category,
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

    public function delete(Category $category)
    {
        if(hasRole('administrator', $this->user)) {
            $category->forceDelete();
            return response()->json([
                'message' => trans('Category was permanently removed.'),
                'status' => 'error',
                'data' => [],
                'type' => ''
            ]);
        }

        if(hasRole('author', $this->user) && $this->user->id == $category->user_id) {
            $category->forceDelete();
            return response()->json([
                'message' => trans('Category was permanently removed.'),
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
