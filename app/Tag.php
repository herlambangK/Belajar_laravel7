<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tag extends Model
{
    protected $fillable=['name', 'slug'];
    public function posts(){
        // return BelongsToMany(post::class, 'post_tag');
        return $this->BelongsToMany(post::class);
    }
}