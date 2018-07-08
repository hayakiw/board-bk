<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Account extends Authenticatable
{

    use SoftDeletes;

    // protected $table = 'accounts';

    protected $fillable = [
        'email',
        'password',
        'is_signed_up',
        'first_name',
        'last_name',
        'first_name_kana',
        'last_name_kana',
    ];

    protected $hidden = [
        'password',
    ];

    public function getName()
    {
        return $this->first_name;
    }
}
