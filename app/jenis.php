<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class jenis extends Model
{
  protected $table = 'barang_jenis';

  protected $fillable = [
      'nama',
  ];
}
