<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Statistik extends Model
{
    protected $table = "statistik";
    protected $fillable = ['mitra_id','kegiatan_id','value'];
}
