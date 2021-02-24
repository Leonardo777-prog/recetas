<?php

namespace App\Http\Controllers;

use App\Categoria;
use App\Receta;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    //
    public function show(Categoria $categoria)
    {
        $categroiaNombre = $categoria->nombre;
        $recetas = Receta::where('categoria_id', $categoria->id)->paginate(3);
        return view('categorias.show')
            ->with('recetas', $recetas)
            ->with('nombre', $categroiaNombre);
    }
}
