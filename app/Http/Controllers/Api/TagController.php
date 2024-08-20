<?php

namespace App\Http\Controllers\Api;

use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;

class TagController extends Controller
{
    public function tags()
    {
        if (hasAnyRole(['administrator', 'author'])) {
            return response()->json([
                'message' => trans('You do not have permission to perform this action.'),
                'status' => 'error',
                'data' => [],
                'type' => 'unauthorized'
            ], 401);
        }

        $data = [];

        if (hasRole('administrator')) {
            $data = Cache::rememberForever('all-tags', function () {
                return Tag::orderBy('name')->get();
            });
        }

        if (hasRole('author') && !hasRole('administrator')) {
            $data = Cache::rememberForever('author-tags-' . auth()->user()->id, function () {
                return Tag::orderBy('name')->where(function ($query) {
                    $query->whereNull('user_id')
                        ->orWhere('user_id', auth()->user()->id);
                })->get();
            });
        }

        return response()->json([
            'message' => '',
            'status' => 'success',
            'data' => $data,
            'type' => '',
        ], 200);
    }

    public function tag($id)
    {
        if (hasAnyRole(['administrator', 'author'])) {
            return response()->json([
                'message' => trans('You do not have permission to perform this action.'),
                'status' => 'error',
                'data' => [],
                'type' => 'unauthorized'
            ], 401);
        }

        if(hasRole('administrator')) {

        }
    }

    public function store()
    {

    }

    public function update($id, Request $request)
    {

    }

    public function trash($id)
    {

    }

    public function restore($id)
    {

    }

    public function delete($id)
    {

    }
}
