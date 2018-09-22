<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Workspace extends Model
{

    use SoftDeletes;

    // protected $table = '';

    protected $fillable = [
        'name', 'description',
    ];

    public function Accounts()
    {
        return $this->belongsToMany(\App\Models\Account::class, 'accounts_workspaces')
            ->using(\App\Models\AccountWorkspace::class)
            ->as('property')
            ->withPivot('invite_at', 'entry_at', 'role')
            ->withTimestamps();
    }

    public function Groups()
    {
        return $this->hasMany(\App\Models\Group::class);
    }

    public function Group($id)
    {
        return $this->Groups()
            ->where('id', $id)
            ;
    }
}
