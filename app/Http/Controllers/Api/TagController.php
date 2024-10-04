<?php

namespace App\Http\Controllers\Api;

use App\Models\Tag;
use App\Models\UserToken;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\CategoryTagResource;

class TagController extends Controller
{
    protected $user = null;

    public function __construct(Request $request)
    {
        $this->user = Auth::user();
    }

    public function tags()
    {
        if (!hasAnyRole(['administrator', 'author'], $this->user)) {
            return response()->json([
                'message' => trans('Você não possui permissão para realizar essa ação.'),
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

    public function tag($id)
    {
        if (!hasAnyRole(['administrator', 'author'], $this->user)) {
            return response()->json([
                'message' => trans('Você não possui permissão para realizar essa ação.'),
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
                'message' => trans('Você não possui permissão para realizar essa ação.'),
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
                'message' => trans('Você não possui permissão para realizar essa ação.'),
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

    public function trash(Tag $tag)
    {
        if(hasRole('administrator', $this->user)) {
            $tag->delete();
            return response()->json([
                'message' => trans('Tag successfully removed but it still can be restored.'),
                'status' => 'error',
                'data' => [],
                'type' => ''
            ]);
        }

        if(hasRole('author', $this->user) && $tag->user_id == $this->user->id) {
            $tag->delete();
            return response()->json([
                'message' => trans('Tag successfully removed but it still can be restored.'),
                'status' => 'error',
                'data' => [],
                'type' => ''
            ]);
        }

        return response()->json([
            'message' => trans('Você não possui permissão para realizar essa ação.'),
            'status' => 'error',
            'data' => [],
            'type' => 'unauthorized'
        ], 401);
    }

    public function restore(Tag $tag)
    {
        if(hasRole('administrator', $this->user)) {
            $tag->restore();
            return response()->json([
                'message' => trans('Tag was restored.'),
                'status' => 'error',
                'data' => $tag,
                'type' => ''
            ]);
        }

        if(hasRole('author', $this->user) && $this->user->id == $tag->user_id) {
            $tag->restore();
            return response()->json([
                'message' => trans('Tag was restored.'),
                'status' => 'error',
                'data' => $tag,
                'type' => ''
            ]);
        }

        return response()->json([
            'message' => trans('Você não possui permissão para realizar essa ação.'),
            'status' => 'error',
            'data' => [],
            'type' => 'unauthorized'
        ], 401);
    }

    public function delete(Tag $tag)
    {
        if(hasRole('administrator', $this->user)) {
            $tag->forceDelete();
            return response()->json([
                'message' => trans('Tag was permanently removed.'),
                'status' => 'error',
                'data' => [],
                'type' => ''
            ]);
        }

        if(hasRole('author', $this->user) && $this->user->id == $tag->user_id) {
            $tag->forceDelete();
            return response()->json([
                'message' => trans('Tag was permanently removed.'),
                'status' => 'error',
                'data' => [],
                'type' => ''
            ]);
        }

        return response()->json([
            'message' => trans('Você não possui permissão para realizar essa ação.'),
            'status' => 'error',
            'data' => [],
            'type' => 'unauthorized'
        ], 401);
    }
}
