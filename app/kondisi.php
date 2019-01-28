<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class kondisi extends Model
{
    protected $table = 'kondisi';

    protected $fillable = [
        'nama',
    ];
}
