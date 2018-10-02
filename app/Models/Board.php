<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Board extends Model
{

    use SoftDeletes;

    // protected $table = '';

    protected $fillable = [
        'group_id', 'title', 'description',
    ];

    public function Group()
    {
        return $this->belongsTo(\App\Models\Group::class);
    }

    public function Comments()
    {
        return $this->morphMany(\App\Models\Comment::class, 'commentable');
    }

    public function new()
    {
        return $this->comments()
            ->orderBy('created_at', 'desc')
            ->first()
            ;
    }

    public function getSequence()
    {
        $comment = $this->comments()
            ->withTrashed()
            ->orderBy('seq', 'desc')
            ->first()
            ;

        return ($comment && $comment->seq) ? $comment->seq + 1 : 1;
    }
}
