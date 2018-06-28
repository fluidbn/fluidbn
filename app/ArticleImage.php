<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArticleImage extends Model
{
    public function imagesOf(){
        return $this->belongsTo('App\Article','article_id')->withTimestamps();
    }
}
