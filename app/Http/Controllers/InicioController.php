<?php

namespace App\Http\Controllers;

use App\Receta;
use App\Categoria;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class InicioController extends Controller
{
    //
    public function index()
    {
        // recetas por cantidad de votos
        // $votadas = Receta::has('like', '>', 1)->get();
        $votadas = Receta::withCount('like')->orderby('like_count', 'desc')->take(3)->get();

        // obtener todas las categorias
        $categorias = Categoria::all();

        $recetas = [];

        foreach ($categorias as $categoria) {
            $recetas[Str::slug($categoria->nombre)][] = Receta::where('categoria_id', $categoria->id)->take(3)->get();
        }

        $nuevas = Receta::latest()->take(6)->get();
        return view('inicio.index')
            ->with('recetas', $nuevas)
            ->with('recetasCategorias', $recetas)
            ->with('votadas', $votadas);
    }
}
