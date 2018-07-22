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
        return $this->belongsToMany(\App\Models\AccountWorkspace::class, 'accounts_workspaces')->withPivot('invite_at', 'entry_at');
    }

    public function Groups()
    {
        return $this->hasMany(\App\Models\Group::class);
    }
}
