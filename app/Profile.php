<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    public function profileOf(){
        return $this->hasOne('App\User','user_id');
    }
}
