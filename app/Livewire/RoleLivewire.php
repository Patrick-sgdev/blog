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
                    'message' => trans('This is a core role of the system and cannot be deleted.'),
                ]);
                return;
            }
            
            $role->delete();
            Cache::forget('roles');
            $this->dispatch('refreshDatatable');
            $this->dispatch('showToastAlert', [
                'icon' => 'success',
                'message' => trans('Role successfully deleted.'),
            ]);
            return;
        }

        $this->dispatch('showToastAlert', [
            'icon' => 'error',
            'message' => trans('You do not have permission to perform this action.'),
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
                'message' => trans('You do not have permission to perform this action.'),
            ]);
        }

        $this->validate();

        Role::updateOrCreate([
            'id' => $this->role?->id
        ], [
            'name' => $this->name,
            'description' => $this->description,
        ]);
        Cache::forget('roles');

        $this->dispatch('refreshDatatable');
        $this->dispatch('showToastAlert', [
            'icon' => 'success',
            'message' => $this->role ? trans('Role successfully updated.') : trans('Role successfully created'),
        ]);
    }
    public function render()
    {
        return view('livewire.role-livewire');
    }
}
