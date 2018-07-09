<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attache extends Model
{

    use SoftDeletes;

    // protected $table = '';

    protected $fillable = [
        'path', 'attacheable_id', 'attacheable_type',
    ];
}
