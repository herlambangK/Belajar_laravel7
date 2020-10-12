<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;

class post extends Model
{
    protected $fillable = ['title', 'slug', 'body','category_id','thumbnail'];
    protected $with = ['author', 'category','tags'];
    //
    // protected $table = 'post'; digunakan untuk memperkenalkan nama ke db 
    public function getRouteKeyName()
    {
        // return 'slug';
    }

    public function category(){
        return $this->belongsTo(category::class);
    }
    // protected $guarded = [];

    // public function takeImage()
    // {
    //     return "storage/". $this->thumbnail;
    // }    

    public function getTakeImageAttribute()
    {
        //menjadikan atribut
        return "storage/". $this->thumbnail;
    }    
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    //memasukan user ke post
    public function author(){
        return $this->belongsTo(User::class, 'user_id');
    }
    public function gravatar($size =150){
       
        return "https://www.gravatar.com/avatar/" . md5( strtolower( trim( $this->author->email ) ) ) . "?d=mp&s=" . "&s=" . $size;
    }

}