<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Permission extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = ['id'];

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
}
