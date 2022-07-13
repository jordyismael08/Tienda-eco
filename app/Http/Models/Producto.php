<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Producto extends Model
{
    //
    use SoftDeletes;
    protected $dates =[ 'deleted_at'];
    protected $table = 'productos';
    protected $hidden = ['created_at','updated_at'];
    public function cat(){
        return $this->hasOne(Categoria::class,'id','categoria_id');
    }

    public function getGallery(){
        return $this->hasMany(PGaleria::class,'producto_id','id');

    }

}
