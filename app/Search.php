<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Search extends Model
{
    public function searchedBy(){
        return $this->belongsToMany('App\User','search_words','search_id','user_id')->withTimestamps();
    }

}
