<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{   

   public function getRouteKeyName(){
             return 'name';
    }
    public function genreOf(){
        return $this->belongsToMany('App\User','has_genres','genre_id','user_id');
    }
    public function hasArticles(){
        return $this->hasMany('App\Article','genre_id');
    }
    public function hasSavedArticles(){
        return $this->hasMany('App\SavedArticle','genre_id');
    }
    public function windows(){
        return $this->hasMany('App\Window','genre_id');
    }
}
