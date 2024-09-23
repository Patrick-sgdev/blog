<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Facades\Cache;

class CategoryLivewire extends Component
{
    public $category;
    public $name;
    public $description;

    protected $listeners = [
        'deleteCategory' => 'deleteCategory' 
    ];

    public function deleteCategory(Category $category)
    {
        if (hasRole('administrator')) {
            $category->delete();    
            Cache::forget('categories');
            $this->dispatch('refreshDatatable');
            $this->dispatch('showToastAlert', [
                'icon' => 'success',
                'message' => trans('Category successfully deleted.'),
            ]);
            return;
        }

        if (hasRole('author') && $category->user_id == auth()->user()->id) {
            $category->delete();    
            Cache::forget('categories');
            $this->dispatch('refreshDatatable');
            $this->dispatch('showToastAlert', [
                'icon' => 'success',
                'message' => trans('Category successfully deleted.'),
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
        if($this->category) {
            $this->name = $this->category->name;
            $this->description = $this->category->description;
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

        Category::updateOrCreate([
            'id' => $this->category?->id,
            'user_id' => auth()->user()->id,
        ], [
            'name' => $this->name,
            'description' => $this->description,
        ]);
        Cache::forget('categories');
        $this->dispatch('refreshDatatable');
        $this->dispatch('showToastAlert', [
            'icon' => 'success',
            'message' => $this->category ? trans('Category successfully updated.') : trans('Category successfully created'),
        ]);
    }

    public function render()
    {
        return view('livewire.category-livewire');
    }
}
