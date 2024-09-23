<?php

namespace App\Livewire;

use App\Models\Tag;
use App\Models\Post;
use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;

class PostLivewire extends Component
{
    use WithFileUploads;

    public $categoriesArray = [];
    public $categories;
    public $tagsArray = [];
    public $tags;
    public $title;
    public $banner;
    public $content;
    public $short_description;
    public $status = 'draft';

    public $post;

    protected $listeners = [
        'store' => 'store',
        'deletePost' => 'deletePost'
    ];

    public function rules()
    {
        return [
            'banner' => $this->post ? 'nullable|file|mimes:jpg,jpeg,png,webp|max:3000' : 'required|file|mimes:jpg,jpeg,png,webp|max:3000',
            'status' => 'required|in:draft,published',
            'title' => 'required|min:2|max:255',
            'short_description' => 'required|min:2|max:255',
            'content' => 'required|max:100000000',
            'categories' => 'required|array',
            'categories.*' => 'required|in:' . implode(',', $this->getCategories()->pluck('id')->toArray()),
            'tags' => 'nullable|array',
            'tags.*' => 'nullable|in:' . implode(',', $this->getTags()->pluck('id')->toArray())
        ];
    }

    public function getCategories()
    {
        return Cache::remember('categories', 60, function () {
            return Category::select('id', 'name')->get();
        });
    }

    public function getTags()
    {
        return Cache::remember('tags', 60, function () {
            return Tag::select('id', 'name')->get();
        });
    }

    public function mount()
    {
        $this->categoriesArray = $this->getCategories();
        $this->tagsArray = $this->getTags();

        if ($this->post) {
            $this->title = $this->post->title;
            $this->status = $this->post->status;
            $this->content = $this->post->content;
            $this->short_description = $this->post->short_description;
            $this->categories = $this->post->categories->pluck('id')->toArray();
            $this->tags = $this->post->tags->pluck('id')->toArray();
        }
    }

    public function store($content)
    {
        $this->content = $content;
        $this->validate();

        $filename = null;
        if ($this->banner) {
            $filename = Str::random(20) . '.' . $this->banner->getClientOriginalExtension();
            $this->banner->storeAs('public/posts/banner/', $filename);
        }
        
        try {
            $post = Post::updateOrCreate(attributes: [
                'id' => $this->post?->id
            ], values: [
                'user_id' => auth()->user()->id,
                'title' => $this->title,
                'banner' => $this->banner ? 'storage/posts/banner/' . $filename : $this->post->banner,
                'content' => $this->content,
                'status' => $this->status,
                'slug' => Str::slug($this->title),
                'short_description' => $this->short_description,
            ]);

            if ($this->categories) {
                $post->categories()->sync($this->categories);
            }

            if ($this->tags) {
                $post->tags()->sync($this->tags);
            }
            DB::commit();
            $this->dispatch('refreshDatatable');
            $this->dispatch('showToastAlert', [
                'icon' => 'success',
                'message' => $this->post ? trans('Post successfully updated.') : trans('Post successfully created'),
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            $this->dispatch('showToastAlert', [
                'icon' => 'error',
                'message' => $th->getMessage(),
            ]);
        }
    }

    public function deletePost(Post $post)
    {
        if (hasRole('administrator')) {
            $post->delete();
            $this->dispatch('refreshDatatable');
            $this->dispatch('showToastAlert', [
                'icon' => 'success',
                'message' => trans('Post successfully deleted.'),
            ]);
            return;
        }

        if (hasRole('author') && $post->user_id == auth()->user()->id) {
            $post->delete();
            $this->dispatch('refreshDatatable');
            $this->dispatch('showToastAlert', [
                'icon' => 'success',
                'message' => trans('Post successfully deleted.'),
            ]);
            return;
        }

        $this->dispatch('showToastAlert', [
            'icon' => 'error',
            'message' => trans('You do not have permission to perform this action'),
        ]);

    }

    public function render()
    {
        return view('livewire.post-livewire');
    }
}
