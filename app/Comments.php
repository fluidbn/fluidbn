<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    public function ofArticle(){
        return $this->belongsTo('App\Article','article_id');
    }
    public function commentedBy(){
        return $this->belongsTo('App\User','user_id');
    }
}
