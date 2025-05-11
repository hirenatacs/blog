<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommentMeta extends Model
{
    protected $table = 'comment_meta';
    public $timestamps = false;

    public function comment()
    {
        return $this->belongsTo(Comment::class);
    }
}
