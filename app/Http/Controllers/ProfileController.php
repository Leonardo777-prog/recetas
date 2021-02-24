<?php

namespace App\Http\Controllers;

use App\Profile;
use App\Receta;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{
    // /**
    //  * Display a listing of the resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function index()
    // {
    //     //
    // }

    // /**
    //  * Show the form for creating a new resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function create()
    // {
    //     //
    // }

    // /**
    //  * Store a newly created resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @return \Illuminate\Http\Response
    //  */
    // public function store(Request $request)
    // {
    //     //
    // }

    public function __construct()
    {
        $this->middleware('auth', ['except' => 'show']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function show(Profile $profile)
    {
        $recetas = Receta::where('user_id', $profile->user_id)->paginate(3);
        return view('perfiles.show')
            ->with('profile', $profile)
            ->with('recetas', $recetas);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function edit(Profile $profile)
    {
        $this->authorize('view', $profile);
        return view('perfiles.edit')
            ->with('profile', $profile);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Profile $profile)
    {

        $this->authorize('update', $profile);
        // Validar
        $data = $request->validate([
            'nombre' => 'required',
            'pageweb' => 'required',
            'biografia' => 'required',
        ]);

        if ($request['imagen']) {
            $ruta_imagen = $request['imagen']->store('upload-perfiles', 'public');

            $ruta = public_path("storage/$ruta_imagen");
            // dd($ruta);

            $img = Image::make($ruta)->fit(600, 600);
            $img->save();
            $array_img = ['imagen' => $ruta_imagen];
        }

        // asignar nombre y url
        auth()->user()->pageweb = $data['pageweb'];
        auth()->user()->name = $data['nombre'];
        auth()->user()->save();

        unset($data['nombre']);
        unset($data['pageweb']);

        auth()->user()->perfil()->update(
            array_merge(
                $data,
                $array_img ?? []
            )
        );

        return redirect()->action('RecetaController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profile $profile)
    {
        //
    }
}
