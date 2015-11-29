<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Protocols extends Model
{

    public function owner()
    {
        return $this->hasOne('App\User');
    }

}
