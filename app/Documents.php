<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Documents extends Model
{

    protected $table = 'documents';
    protected $guarded = ['id'];

    public function owner()
    {
        return $this->hasOne('App\User');
    }

}
