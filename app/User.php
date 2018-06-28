<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Balping\HashSlug\HasHashSlug;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    use HasHashSlug;

    protected static $minSlugLength = 10;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fname','lname', 'email', 'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token'
    ];
    
   /* public function getRouteKeyName()
    {
       return 'identifier'; // use the 'user.identifier' column for look ups within the database
    }*/
    public function hasProfile(){
        return $this->hasOne('App\Profile','user_id');
    }

    public function hasGenre(){
        return $this->belongsToMany('App\Genre','has_genres','user_id','genre_id')->withTimestamps();
    }

    public function writes(){
        return $this->hasMany('App\Article','user_id');
    }
     
    public function saves(){
        return $this->hasMany('App\SavedArticle','user_id');
    }

    public function follows(){
        return $this->belongsToMany('App\User','follow','follower_id','following_id')->withTimestamps();
    }

    public function followedBy(){
        return $this->belongsToMany('App\User','follow','following_id','follower_id')->withTimestamps();
    }

    public function likes(){
        return $this->belongsToMany('App\Article','like','user_id','article_id')->withTimestamps();
    
    }
    public function bookmarks(){
        return $this->belongsToMany('App\Article','bookmark','user_id','article_id')->withTimestamps();
    }

    public function searches(){
        return $this->belongsToMany('App\Search','search_words','user_id','search_id')->withTimestamps();
    }
    public function hasWindow(){
        return $this->hasMany('App\Window','user_id');
    }
    public function views(){
        return $this->belongsToMany('App\Article','user_views','viewer_id','article_id')->withTimestamps();
    }
    public function comments(){
        return $this->hasMany('App\Comments','user_id');
    }

}

