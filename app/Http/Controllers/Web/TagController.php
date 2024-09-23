<?php

namespace App\Http\Controllers\Web;

use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TagController extends Controller
{
    public function tags()
    {
        return view('dashboard.tags');
    }

    public function edit(Tag $tag)
    {
        return view(view: 'dashboard.tags.edit')->with([
            'tag' => $tag
        ]);
    }
}
