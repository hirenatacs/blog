<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    public function user()
    {
        $this->belongsTo(User::class);
    }

    public function postMeta(){
        return $this->hasMany(PostMeta::class);
    }

    public function taxonomies()
    {
        return $this->belongsToMany(TermTaxonomy::class, 'term_relationships');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
