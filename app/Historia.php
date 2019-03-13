<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Historia extends Model
{
    //
    protected $table = 'historia';

    protected $fillable = ['dni','hc'];
}
