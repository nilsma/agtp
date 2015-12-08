<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Protocols extends Model
{

    # protected $table = 'protocols';
    # protected $guarded = ['id'];

    protected $guarded = [];

    public function owner()
    {
        return $this->belongsTo('App\User', 'owner_id');
    }

}
