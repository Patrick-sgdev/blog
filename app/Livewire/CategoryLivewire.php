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
            Cache::forget('categories-'. auth()->user()->id);
            $this->dispatch('refreshDatatable');
            $this->dispatch('showToastAlert', [
                'icon' => 'success',
                'message' => trans('Categoria removida com sucesso.'),
            ]);
            return;
        }

        if (hasRole('author') && $category->user_id == auth()->user()->id) {
            $category->delete();    
            Cache::forget('categories-'. auth()->user()->id);
            $this->dispatch('refreshDatatable');
            $this->dispatch('showToastAlert', [
                'icon' => 'success',
                'message' => trans('Categoria removida com sucesso.'),
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
                'message' => trans('Você não possui permissão para realizar essa ação.'),
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

        if(!$this->category) {
            $this->name = null;
            $this->description = null;
        }

        Cache::forget('categories-'. auth()->user()->id);
        $this->dispatch('refreshDatatable');
        $this->dispatch('showToastAlert', [
            'icon' => 'success',
            'message' => $this->category ? trans('Categoria atualizada com sucesso.') : trans('Categoria criada com sucesso.'),
        ]);
    }

    public function render()
    {
        return view('livewire.category-livewire');
    }
}
