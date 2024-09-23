<?php

namespace App\Livewire;

use App\Models\Role;
use App\Models\User;
use Pest\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cache;

class UserLivewire extends Component
{
    use WithFileUploads;
    public $user;
    public $name;
    public $email;
    public $profile_picture;
    public $password;
    public $rolesArray = [];
    public $roles;

    public $description;

    protected $listeners = [
        'deleteUser' => 'deleteUser'
    ];

    public function deleteUser(User $user)
    {
        if (hasRole('administrator')) {
            $user->delete();
            $this->dispatch('refreshDatatable');
            $this->dispatch('showToastAlert', [
                'icon' => 'success',
                'message' => trans('User successfully deleted.'),
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
            'password' => $this->user ? 'nullable|min:4|max:36' : 'required|min:4|max:36',
            'email' => 'required|email|max:255|unique:users,email,' . $this->user?->id,
            'profile_picture' => 'nullable|file|mimes:jpg,jpeg,png,webp|max:3000',
            'roles' => 'required|array',
            'roles.*' => 'required|in:' . implode(',', $this->getRoles()->pluck('id')->toArray()),
        ];
    }

    public function mount()
    {
        $this->rolesArray = $this->getRoles();
        if ($this->user) {
            $this->name = $this->user->name;
            $this->email = $this->user->email;
            $this->roles = $this->user->roles?->pluck('id')->toArray();
        }
    }

    public function getRoles()
    {
        return Cache::remember('roles', 60, function () {
            return Role::select('id', 'name')->get();
        });
    }

    public function store()
    {
        if (!hasRole('administrator')) {
            $this->dispatch('showToastAlert', [
                'icon' => 'error',
                'message' => trans('You do not have permission to perform this action.'),
            ]);
        }

        $this->validate();

        try {
            $filename = null;
            if ($this->profile_picture) {
                $filename = Str::random(20) . '.' . $this->profile_picture->getClientOriginalExtension();
                $this->profile_picture->storeAs('public/users/', $filename);
            }

            $user = User::updateOrCreate([
                'id' => $this->user?->id
            ], [
                'name' => $this->name,
                'email' => $this->email,
                'password' => $this->password ? Hash::make($this->password) : $this->user->password,
                'profile_photo_path' => $this->profile_picture ? 'storage/users/' . $filename  : $this->user->profile_photo_path,
            ]);
            DB::commit();
            $user->roles()->sync($this->roles);
            $this->dispatch('refreshDatatable');
            $this->dispatch('showToastAlert', [
                'icon' => 'success',
                'message' => $this->user ? trans('User successfully updated.') : trans('User successfully created'),
            ]);

        } catch (\Throwable $th) {
            DB::rollBack();
            $this->dispatch('showToastAlert', [
                'icon' => 'error',
                'message' => $th->getMessage(),
            ]);
        }
    }
    public function render()
    {
        return view('livewire.user-livewire');
    }
}
