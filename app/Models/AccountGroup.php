<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\SoftDeletes;

class AccountGroup extends Pivot
{

    use SoftDeletes;

    protected $table = 'accounts_groups';

    protected $fillable = [
        'account_id', 'group_id',
        'role',
        'invite_at', 'entry_at',
    ];
}
