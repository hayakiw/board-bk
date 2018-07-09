<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AccountGroup extends Model
{

    use SoftDeletes;

    protected $table = 'accounts_groups';

    protected $fillable = [
        'account_id', 'group_id',
        'role',
        'invite_at', 'entry_at',
    ];
}
