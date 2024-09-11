<?php

use Illuminate\Support\Facades\File;

if (!function_exists('asset_path')) {
    /**
     * Returns the asset path with a public prefix
     *
     * @param string $path
     *
     * @return string
     */
    function asset_path($path)
    {
        if (File::exists('public/' . $path)) {
            return asset('/public/' . $path);
        }
        
        if(File::exists($path)) {
            return asset($path);
        }

        if(str_contains($path, 'http')) {
            return $path;
        }

        return asset('https://fakeimg.pl/600x400?text=MEDIA+NOT+FOUND');
    }
}

if (!function_exists('hasRole')) {
    /**
     * Check if user has the role
     *
     * @param  string $name
     * @param  App\Models\User $user
     * @return boolean
     */
    function hasRole($name, $user = null)
    {
        if ($user) {
            return $user->hasRoleByName($name);
        }

        if (!auth()->user()) {
            return false;
        }

        return auth()->user()->hasRoleByName($name);
    }
}

if (!function_exists('hasAnyRole')) {
    /**
     * Check if user contain any of the roles passed
     *
     * @param  array $roles
     * @param  App\Models\User $user
     * @return boolean
     */
    function hasAnyRole(array $roles, $user = null): bool
    {
        $user = $user ? $user : auth()->user();

        if (!$user) {
            return false;
        }

        $userRoles = $user->roles->pluck('name')->toArray();

        if (count(array_intersect($userRoles, $roles)) > 0) {
            return true;
        }

        return false;
    }
}