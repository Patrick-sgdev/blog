<?php

namespace App\Livewire;

use App\Models\Role;
use Livewire\Component;
use Illuminate\Support\Facades\Cache;

class RoleLivewire extends Component
{
    public $role;
    public $name;
    public $description;

    protected $listeners = [
        'deleteRole' => 'deleteRole' 
    ];

    public function deleteRole(Role $role)
    {
        if (hasRole('administrator')) {
            if(in_array($role->name, ['author', 'administrator'])) {
                $this->dispatch('showToastAlert', [
                    'icon' => 'error',
                    'message' => trans('Esta é uma função central do sistema e não pode ser excluída.'),
                ]);
                return;
            }
            
            $role->delete();
            Cache::forget('roles-'. auth()->user()->id);
            $this->dispatch('refreshDatatable');
            $this->dispatch('showToastAlert', [
                'icon' => 'success',
                'message' => trans('Função removida com sucesso.'),
            ]);
            return;
        }

        $this->dispatch('showToastAlert', [
            'icon' => 'error',
            'message' => trans('Você não possui permissão para realizar essa ação.'),
        ]);

    }

    public function rules()
    {
        return [
            'name' => 'required|min:2|max:255|unique:roles,name',
            'description' => 'nullable|min:2|max:255',
        ];
    }

    public function mount()
    {
        if($this->role) {
            $this->name = $this->role->name;
            $this->description = $this->role->description;
        }
    }

    public function store()
    {
        if(!hasRole('administrator')) {
            $this->dispatch('showToastAlert', [
                'icon' => 'error',
                'message' => trans('Você não possui permissão para realizar essa ação.'),
            ]);
        }

        $this->validate();

        Role::updateOrCreate([
            'id' => $this->role?->id
        ], [
            'name' => $this->name,
            'description' => $this->description,
        ]);

        if(!$this->role) {
            $this->name = null;
            $this->description = null;
        }
        
        Cache::forget('roles-'. auth()->user()->id);

        $this->dispatch('refreshDatatable');
        $this->dispatch('showToastAlert', [
            'icon' => 'success',
            'message' => $this->role ? trans('Função atualizada com sucesso.') : trans('Função criada com sucesso.'),
        ]);
    }
    public function render()
    {
        return view('livewire.role-livewire');
    }
}
