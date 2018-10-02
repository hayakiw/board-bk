<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{

    use SoftDeletes;

    // protected $table = '';

    protected $fillable = [
        'comment', 'commentable_id', 'commentable_type', 'account_id', 'seq',
    ];

    public function commentable()
    {
        return $this->morphTo();
    }

    public function Account()
    {
        return $this->belongsTo(\App\Models\Account::class);
    }
}
