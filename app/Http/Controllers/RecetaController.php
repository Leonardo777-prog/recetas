<?php

namespace App\Http\Controllers;

use App\Receta;
use App\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class RecetaController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth')->except(['show', 'search']);
        // , ['except' => 'show']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // Usamos el metodo del modelo para traer las recetas
        // Auth::user()->recetas->dd();
        // $receta = Auth::user()->recetas;
        $meGusta = auth()->user()->meGusta;
        $perfil = Auth::user()->perfil;

        $usuario = auth()->user()->id;
        $recetas = Receta::where('user_id', $usuario)->paginate(2);

        return view('recetas.index')
            ->with('recetas', $recetas)
            ->with('perfil', $perfil)
            ->with('meGusta', $meGusta);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        // Obtener las categorias sin modelo
        // $categorias = DB::table('categorias')
        //     ->get()
        //     ->pluck('nombre', 'id');
        // ->dd();


        // obtener las categorias con model
        $categorias = Categoria::all(['id', 'nombre']);
        return view('recetas.create')
            ->with('categorias', $categorias);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        // dd($request);
        $data = $request->validate([
            'titulo' => 'required|min:6',
            'categoria_id' => 'required',
            'preparacion' => 'required',
            'ingredientes' => 'required',
            'imagen' => 'required|image'
        ]);
        // obtener la ruta de la imagen sin modelo
        // dd($data);
        $ruta_imagen = $request['imagen']->store('upload-recetas', 'public');

        $ruta = public_path("storage/$ruta_imagen");
        // dd($ruta);

        $img = Image::make($ruta)->fit(1000, 550);
        $img->save();

        auth()->user()->recetas()->create([
            'titulo' => $data['titulo'],
            'ingredientes' => $data['ingredientes'],
            'categoria_id' => $data['categoria_id'],
            'imagen' => $ruta_imagen,
            'preparacion' => $data['preparacion']
        ]);

        // DB::table('recetas')->insert([
        //     'titulo' => $data['titulo'],
        //     'ingredientes' => $data['ingredientes'],
        //     'user_id' => Auth::user()->id,
        //     'categoria_id' => $data['categoria_id'],
        //     'imagen' => $ruta_imagen,
        //     'preparacion' => $data['preparacion']
        // ]);

        return redirect()->action('RecetaController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function show(Receta $receta)
    {
        //Obtener si el usuario ya le dio me gusta a la recetas

        $like = (auth()->user()) ? auth()->user()->meGusta->contains($receta->id) : false;

        // la cantidada de likes que tiene una recta

        $likes = $receta->like()->count();

        return view('recetas.show', compact('receta', 'like', 'likes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function edit(Receta $receta)
    {
        $this->authorize('view', $receta);
        $categorias = Categoria::all(['nombre', 'id']);
        return view('recetas.edit')
            ->with('categorias', $categorias)
            ->with('receta', $receta);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Receta $receta)
    {
        $this->authorize('update', $receta);
        $data = $request->validate([
            'titulo' => 'required|min:6',
            'categoria_id' => 'required',
            'preparacion' => 'required',
            'ingredientes' => 'required',
        ]);

        if ($request['imagen']) {
            $ruta_imagen = $request['imagen']->store('upload-recetas', 'public');

            $ruta = public_path("storage/$ruta_imagen");
            // dd($ruta);

            $img = Image::make($ruta)->fit(1000, 550);
            $img->save();
            $receta->imagen = $ruta_imagen;
        }

        // dd('nada');
        $receta->titulo = $data['titulo'];
        $receta->categoria_id = $data['categoria_id'];
        $receta->preparacion = $data['preparacion'];
        $receta->ingredientes = $data['ingredientes'];
        $receta->save();
        return redirect()->action('RecetaController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Receta $receta)
    {
        //
        $this->authorize('delete', $receta);
        $receta->delete();
        return redirect()->action('RecetaController@index');
    }

    public function search(Request $request)
    {
        $busqueda = $request['buscar'];
        $recetas = Receta::where('titulo', 'like', '%' . $busqueda . '%')->paginate(1);
        $recetas->appends(['buscar' => $busqueda]);
        return view('busquedas.show')
            ->with('recetas', $recetas)
            ->with('nombre', $busqueda);
    }
}
