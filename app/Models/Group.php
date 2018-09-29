<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Group extends Model
{

    use SoftDeletes;

    // protected $table = '';

    protected $fillable = [
        'workspace_id', 'title', 'description',
    ];

    public function Boards()
    {
        return $this->hasMany(\App\Models\Board::class);
    }

    public function Board($id)
    {
        return $this->Boards()
            ->where('id', $id)
            ;
    }
}
