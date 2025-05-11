<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TermRelationship extends Model
{
    use HasFactory;

    protected $table = 'term_relationships';
    public $timestamps = false;

    protected $fillable = [
        'post_id',
        'term_taxonomy_id',
        'term_order',
    ];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function termTaxonomy()
    {
        return $this->belongsTo(TermTaxonomy::class);
    }

    public function term()
    {
        return $this->hasOneThrough(Term::class, TermTaxonomy::class);
    }
}
