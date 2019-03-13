<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dx extends Model
{
    ///
    protected $table = 'dx';

    protected $fillable = [
    	'id_fua',
        'clase',
        'codigo'
    ];
}
