<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'title',
        'slug',
        'creator',
        'description',
        'image',
        'date_creation'
    ];

    static public function generateSlug($ogStr){
        $baseSlug = Str::of($ogStr)->slug('-');
        $slug = $baseSlug;
        $_i = 1;
        while(Post::where('slug', $slug)->first()){
            $slug =  "$baseSlug-$_i";
            $_i++;
        }
        return $slug;
    }
}
