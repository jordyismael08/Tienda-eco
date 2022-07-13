<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PGaleria extends Model
{
    //
    use SoftDeletes;
    protected $dates =[ 'deleted_at'];
    protected $table = 'producto_galeria';
    protected $hidden = ['created_at','updated_at'];
}
