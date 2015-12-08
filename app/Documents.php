<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Documents extends Model
{

    protected $guarded = [];

    public function owner()
    {
        return $this->belongsTo('App\User', 'owner_id');
    }

}
