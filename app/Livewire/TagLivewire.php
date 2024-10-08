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
            Cache::forget('tags-'.auth()->user()->id);
            $this->dispatch('refreshDatatable');
            $this->dispatch('showToastAlert', [
                'icon' => 'success',
                'message' => trans('Tag removida com sucesso.'),
            ]);
            return;
        }

        if (hasRole('author') && $tag->user_id == auth()->user()->id) {
            $tag->delete();
            Cache::forget('tags-'.auth()->user()->id);
            $this->dispatch('refreshDatatable');
            $this->dispatch('showToastAlert', [
                'icon' => 'success',
                'message' => trans('Tag removida com sucesso.'),
            ]);
            return;
        }

        $this->dispatch('showToastAlert', [
            'icon' => 'error',
            'message' => trans('Você não possui permissão para realizar essa ação'),
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
                'message' => trans('Você não possui permissão para realizar essa ação.'),
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
        
        if(!$this->tag) {
            $this->name = null;
            $this->description = null;
        }

        Cache::forget('tags-'.auth()->user()->id);
        $this->dispatch('refreshDatatable');
        $this->dispatch('showToastAlert', [
            'icon' => 'success',
            'message' => $this->tag ? trans('Tag atualizada com sucesso.') : trans('Tag criada com sucesso.'),
        ]);
    }
    public function render()
    {
        return view('livewire.tag-livewire');
    }
}
