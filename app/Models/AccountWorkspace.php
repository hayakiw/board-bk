<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AccountWorkspace extends Model
{

    use SoftDeletes;

    protected $table = 'accounts_workspaces';

    protected $fillable = [
        'account_id', 'workspace_id',
        'role',
        'invite_at', 'entry_at',
    ];

    const ROLE_ADMIN = 'administrator';
    const ROLE_GENERAL = 'general';

    public static function GetRoles()
    {
        return [
            self::ROLE_ADMIN => '管理者',
            self::ROLE_GENERAL => '一般',
        ];
    }
}
