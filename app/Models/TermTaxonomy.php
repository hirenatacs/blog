<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TermTaxonomy extends Model
{
    use HasFactory;
    
    protected $table = 'term_taxonomy';

    public function term()
    {
        return $this->belongsTo(Term::class);
    }

    public function posts()
    {
        return $this->belongsToMany(Post::class,'term_relationships');
    }
}
