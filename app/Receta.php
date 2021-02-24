<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Receta extends Model
{

    protected $fillable = [
        'titulo', 'ingredientes', 'categoria_id', 'imagen', 'preparacion'
    ];

    //
    // obtenr la categoria via llave foranea
    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    // obtener la informacion del user via fk

    public function autor()
    {
        return $this->belongsTo(User::class, 'user_id'); //Le pasmaos a laravel en que campo tiene que ir a hacer la busqueda
    }

    // likes que a recivido
    public function like()
    {
        return $this->belongsToMany(User::class, 'likes_recetas');
    }
}
