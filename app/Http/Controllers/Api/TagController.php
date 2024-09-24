<?php

namespace App\Http\Controllers\Api;

use App\Models\Tag;
use App\Models\UserToken;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\TagTagResource;
use Illuminate\Support\Facades\Validator;

class TagController extends Controller
{
    protected $user = null;

    public function __construct(Request $request)
    {
        $userToken = UserToken::where('public_token', $request->public_token)->first();

        if ($userToken && Hash::check($request->secret_token, $userToken->secret_token)) {
            $this->user = $userToken->user;
        }
    }

    public function tags()
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
            $data = Tag::orderBy('name')->select('id', 'name', 'description')->paginate(10);
        }

        if (hasRole('author', $this->user) && !hasRole('administrator', $this->user)) {
            $data = Tag::orderBy('name')->where(function ($query) {
                $query->whereNull('user_id')
                    ->orWhere('user_id', $this->user->id);
            })->paginate(10);
        }

        return response()->json([
            'message' => '',
            'status' => 'success',
            'data' => TagTagResource::collection($data),
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

    public function tag($id)
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
            $data = Tag::where('id', $id)
                ->select('id', 'name', 'description')
                ->first();
        }

        if (hasRole('author', $this->user)) {
            $data = Tag::where('id', $id)
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

            $tag = Tag::create( [
                'user_id' => $this->user->id,
                'name' => $request->name,
                'description' => $request->description,
            ]);

            return response()->json([
                'message' => trans('Tag successfully created.'),
                'status' => 'success',
                'data' => $tag,
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

    public function update(Tag $tag, Request $request)
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

            $tag->name = $request->name;
            $tag->description = $request->description;
            $tag->save();

            return response()->json([
                'message' => trans('Tag successfully updated.'),
                'status' => 'success',
                'data' => $tag,
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
}
