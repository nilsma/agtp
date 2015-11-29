<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Documents extends Model
{

    # protected $guarded = ['id', 'owner_id', 'created_at', 'updated_at'];

    public function owner()
    {
        return $this->hasOne('App\User');
    }

}
