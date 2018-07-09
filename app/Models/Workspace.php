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
        return $this->hasMany(\App\Models\AccountWorkspace::class)->withPivot('invite_at', 'entry_at');
    }
}
