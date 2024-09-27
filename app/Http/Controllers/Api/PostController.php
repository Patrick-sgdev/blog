<?php

namespace App\Http\Controllers\Api;

use App\Models\Tag;
use App\Models\Post;
use App\Models\Category;
use App\Models\UserToken;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    protected $user = null;

    public function __construct(Request $request)
    {
        $userToken = UserToken::where('public_token', $request->public_token)->first();

        if ($userToken && Hash::check($request->secret_token, $userToken->secret_token)) {
            $this->user = $userToken->user;
        }
    }

    public function getPosts()
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
            $data = Post::with(['tags', 'categories'])->paginate(2);
        }

        if (hasRole('author', $this->user) && !hasRole('administrator', $this->user)) {
            $data = Post::with(['tags', 'categories'])->where('user_id', $this->user->id)->paginate(10);
        }

        return response()->json([
            'message' => '',
            'status' => 'success',
            'data' => PostResource::collection($data),
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

    public function getPost($id)
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
            $data = Post::with(['tags', 'categories'])->where('id', $id)->get();
        }

        if (hasRole('author', $this->user) && !hasRole('administrator', $this->user)) {
            $data = Post::with(['tags', 'categories'])->where('id', $id)->where('user_id', $this->user->id)->get();
        }

        return response()->json([
            'message' => '',
            'status' => 'success',
            'data' => PostResource::collection($data),
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
            'banner' => 'required|file|mimes:jpg,jpeg,png,webp|max:3000',
            'status' => 'required|in:draft,published',
            'title' => 'required|min:2|max:255',
            'short_description' => 'required|min:2|max:255',
            'content' => 'required|max:100000000',
            'categories' => 'required|array',
            'categories.*' => 'required|in:' . implode(',', $this->getCategories()->pluck('id')->toArray()),
            'tags' => 'nullable|array',
            'tags.*' => 'nullable|in:' . implode(',', $this->getTags()->pluck('id')->toArray())
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

            $filename = null;
            if ($request->banner) {
                $filename = Str::random(20) . '.' . $request->banner->getClientOriginalExtension();
                $request->banner->storeAs('public/posts/banner/', $filename);
            }

            $post = Post::create([
                'user_id' => $this->user->id,
                'title' => $request->title,
                'banner' => 'storage/posts/banner/' . $filename,
                'content' => $request->content,
                'status' => $request->status,
                'slug' => Str::slug($request->title),
                'short_description' => $request->short_description,
            ]);

            if ($request->categories) {
                $post->categories()->sync($request->categories);
            }

            if ($request->tags) {
                $post->tags()->sync($request->tags);
            }

            DB::commit();

            return response()->json([
                'message' => trans('Post successfully created.'),
                'status' => 'success',
                'data' => route('show-post', ['slug' => $post->slug, 'id' => $post->id]),
                'type' => ''
            ]);

        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'message' => $th->getMessage(),
                'status' => 'error',
                'data' => [],
                'type' => 'exception'
            ]);
        }
    }

    public function update(Post $post, Request $request)
    {
        if (!hasAnyRole(['administrator', 'author'], $this->user)) {
            return response()->json([
                'message' => trans('You do not have permission to perform this action.'),
                'status' => 'error',
                'data' => [],
                'type' => 'unauthorized'
            ], 401);
        }

        if(!hasRole('administrator', $this->user) && $post->author->id != $this->user->id) {
            return response()->json([
                'message' => trans('You do not have permission to perform this action.'),
                'status' => 'error',
                'data' => [],
                'type' => 'unauthorized'
            ], 401);
        }

        $validator = Validator::make($request->all(), [
            'banner' => 'nullable|file|mimes:jpg,jpeg,png,webp|max:3000',
            'status' => 'required|in:draft,published',
            'title' => 'required|min:2|max:255',
            'short_description' => 'required|min:2|max:255',
            'content' => 'required|max:100000000',
            'categories' => 'required|array',
            'categories.*' => 'required|in:' . implode(',', $this->getCategories()->pluck('id')->toArray()),
            'tags' => 'nullable|array',
            'tags.*' => 'nullable|in:' . implode(',', $this->getTags()->pluck('id')->toArray())
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

            $filename = null;
            if ($request->banner) {
                $filename = Str::random(20) . '.' . $request->banner->getClientOriginalExtension();
                $request->banner->storeAs('public/posts/banner/', $filename);
            }

            $post = Post::updateOrCreate([
                'id' => $post->id,
                'user_id' => $this->user->id,
            ], [
                'title' => $request->title,
                'banner' => $filename ? 'storage/posts/banner/' . $filename : $post->banner,
                'content' => $request->content,
                'status' => $request->status,
                'slug' => Str::slug($request->title),
                'short_description' => $request->short_description,
            ]);

            if ($request->categories) {
                $post->categories()->sync($request->categories);
            }

            if ($request->tags) {
                $post->tags()->sync($request->tags);
            }

            DB::commit();

            return response()->json([
                'message' => trans('Post successfully updated.'),
                'status' => 'success',
                'data' => route('show-post', ['slug' => $post->slug, 'id' => $post->id]),
                'type' => ''
            ]);

        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'message' => $th->getMessage(),
                'status' => 'error',
                'data' => [],
                'type' => 'exception'
            ]);
        }
    }

    public function getCategories()
    {
        return Cache::remember('categories-' . $this->user->id, 60, function () {
            if (hasRole('author', $this->user)) {
                return Category::where('user_id', $this->user->id)->select('id', 'name')->get();
            } else {
                return Category::select('id', 'name')->get();
            }
        });
    }

    public function getTags()
    {
        return Cache::remember('tags-' . $this->user->id, 60, function () {
            if (hasRole('author', $this->user)) {
                return Tag::where('user_id', $this->user->id)->select('id', 'name')->get();
            } else {
                return Tag::select('id', 'name')->get();
            }
        });
    }

    public function trash(Post $post)
    {
        if(hasRole('administrator', $this->user)) {
            $post->delete();
            return response()->json([
                'message' => trans('Post successfully removed but it still can be restored.'),
                'status' => 'error',
                'data' => [],
                'type' => ''
            ]);
        }

        if(hasRole('author', $this->user) && $post->user_id == $this->user->id) {
            $post->delete();
            return response()->json([
                'message' => trans('Post successfully removed but it still can be restored.'),
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

    public function restore(Post $post)
    {
        if(hasRole('administrator', $this->user)) {
            $post->restore();
            return response()->json([
                'message' => trans('Post was restored.'),
                'status' => 'error',
                'data' => $post,
                'type' => ''
            ]);
        }

        if(hasRole('author', $this->user) && $this->user->id == $post->user_id) {
            $post->restore();
            return response()->json([
                'message' => trans('Post was restored.'),
                'status' => 'error',
                'data' => $post,
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

    public function delete(Post $post)
    {
        if(hasRole('administrator', $this->user)) {
            $post->forceDelete();
            return response()->json([
                'message' => trans('Post was permanently removed.'),
                'status' => 'error',
                'data' => [],
                'type' => ''
            ]);
        }

        if(hasRole('author', $this->user) && $this->user->id == $post->user_id) {
            $post->forceDelete();
            return response()->json([
                'message' => trans('Post was permanently removed.'),
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
