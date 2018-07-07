<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'password',
    ];

    protected $hidden = [
        'password',
    ];

    public function getName()
    {
        return $this->name;
    }
}
