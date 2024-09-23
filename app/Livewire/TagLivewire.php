<?php

namespace App\Livewire;

use App\Models\Tag;
use Livewire\Component;
use Illuminate\Support\Facades\Cache;

class TagLivewire extends Component
{
    public $tag;
    public $name;
    public $description;

    protected $listeners = [
        'deleteTag' => 'deleteTag' 
    ];

    public function deleteTag(Tag $tag)
    {
        if (hasRole('administrator')) {
            $tag->delete();
            Cache::forget('tags');
            $this->dispatch('refreshDatatable');
            $this->dispatch('showToastAlert', [
                'icon' => 'success',
                'message' => trans('Tag successfully deleted.'),
            ]);
            return;
        }

        if (hasRole('author') && $tag->user_id == auth()->user()->id) {
            $tag->delete();
            Cache::forget('tags');
            $this->dispatch('refreshDatatable');
            $this->dispatch('showToastAlert', [
                'icon' => 'success',
                'message' => trans('Tag successfully deleted.'),
            ]);
            return;
        }

        $this->dispatch('showToastAlert', [
            'icon' => 'error',
            'message' => trans('You do not have permission to perform this action'),
        ]);

    }

    public function rules()
    {
        return [
            'name' => 'required|min:2|max:255',
            'description' => 'nullable|min:2|max:255',
        ];
    }

    public function mount()
    {
        if($this->tag) {
            $this->name = $this->tag->name;
            $this->description = $this->tag->description;
        }
    }

    public function store()
    {
        if(!hasRole('author') && !hasRole('administrator')) {
            $this->dispatch('showToastAlert', [
                'icon' => 'error',
                'message' => trans('You do not have permission to perform this action.'),
            ]);
        }

        $this->validate();

        Tag::updateOrCreate([
            'id' => $this->tag?->id,
            'user_id' => auth()->user()->id,
        ], [
            'name' => $this->name,
            'description' => $this->description,
        ]);
        Cache::forget('tags');
        $this->dispatch('refreshDatatable');
        $this->dispatch('showToastAlert', [
            'icon' => 'success',
            'message' => $this->tag ? trans('Tag successfully updated.') : trans('Tag successfully created'),
        ]);
    }
    public function render()
    {
        return view('livewire.tag-livewire');
    }
}
