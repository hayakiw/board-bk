<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AccountWorkspace extends Model
{

    use SoftDeletes;

    protected $table = 'accounts_worcspeces';

    protected $fillable = [
        'account_id', 'workspace_id',
        'role',
        'invite_at', 'entry_at',
    ];
}
