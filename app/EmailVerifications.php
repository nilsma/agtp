<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmailVerifications extends Model
{

    protected $guarded = ['token'];

    protected $table = 'email_verifications';

    protected $primaryKey = 'email';

}
