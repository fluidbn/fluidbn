<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Balping\HashSlug\HasHashSlug;
class Article extends Model {

   
   use HasHashSlug;
   protected static $minSlugLength = 10;
   
   /* public function getRouteKeyName()
    {
       return 'identifier'; // use the 'user.identifier' column for look ups within the database
    }*/

 public function writtenBy(){
    return $this->belongsTo('App\User','user_id');
}

public function likedBy(){
    return $this->belongsToMany('App\User','like','article_id','user_id')->withTimestamps();
}


public function bookmarkedBy(){
    return $this->belongsToMany('App\User','bookmark','article_id','user_id')->withTimestamps();
}

public function hasImages(){
    return $this->hasMany('App\ArticleImage','article_id');
}
public function ofGenre(){
    return $this->belongsTo('App\Genre','genre_id');
}

public function viewedBy(){
    return $this->belongsToMany('App\User','user_views','article_id','viewer_id')->withTimestamps();
}
public function hasComents(){
    return $this->hasMany('App\Comments','article_id');
}
}
