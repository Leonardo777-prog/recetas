<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    
public function recetas(){
    return $this->hasMany(Receta::class);
}

}
