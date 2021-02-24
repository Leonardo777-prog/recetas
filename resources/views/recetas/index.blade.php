@extends('layouts.app')
@section('btn')
  @include('ui.navegacion')
@endsection
@section('content')
    <h2 class="text-center mb-5">Tus Recetas</h2>
    <div class="col-md-10 mx-auto bg-white p-3">
        <table class="table">
            <thead class="bg-primary text-light">
                <th>Titulo</th>
                <th>Categoria</th>
                <th>Acciones</th>
            </thead>
            <tbody>
                @foreach ($recetas as $receta)
                    <tr>
                        <td>
                            {{ $receta->titulo }}
                        </td>
                        <td>
                            {{ $receta->categoria->nombre }}
                        </td>
                        <td>
                            <eliminar-receta receta-id={{ $receta->id }}></eliminar-receta>
                            <a href="{{ route('recetas.edit', ['receta' => $receta->id]) }}"
                                class="btn btn-dark d-block w-100 mb-2">Editar</a>
                            <a href="{{ action('RecetaController@show', ['receta' => $receta->id]) }}"
                                class="btn btn-success d-block w-100">Ver</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="col-12 mt-2 justify-content-center d-flex">
            {{$recetas->links()}}
        </div>

        <h2 class="text-center my-5">Recetas que te han Gustado</h2>
        <div class="col-md-10 mx-auto bg-white p-3">
            <ul class="list-group">
                @if ( count($meGusta) > 0 )
                    @foreach ($meGusta as $item)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <h3>{{$item->titulo}}</h3>
                            <a href="{{ route('recetas.show',['receta' => $item->id]) }}" class="btn btn-outline-success">Ver</a>
                        </li>
                    @endforeach    
                @else
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        No el diste me gusta a ninguna receta
                    </li>
                @endif
                
            </ul>
        </div>
    </div>

@endsection
