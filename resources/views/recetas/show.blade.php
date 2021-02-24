@extends('layouts.app')
@section('content')
    <article class="contenido-receta bg-white p-5">
        <h1 class="text-center">{{ $receta->titulo }}</h1>

        <div class="imagen-receta">
            <img src="{{ "/storage/{$receta->imagen}" }}" class="w-100" alt="{{ $receta->titulo }}">
        </div>

        <div class="receta-meta mt-3">
            <p>
                <span class="font-weight-bold text-primary">Escrio en:</span>
                <a href="{{ route('categorias.show', ['categoria' => $receta->categoria->id]) }}" class="text-dark">
                    {{ $receta->categoria->nombre }}
                </a>
            </p>
            <p>
                <span class="font-weight-bold text-primary">Autor :</span>
                {{-- Mostrar el Usuario --}}
                <a href="{{ route('profiles.show',['profile'=>$receta->autor->id]) }}">
                    {{ $receta->autor->name }}
                </a>
            </p>
            <p>
                @php
                    $fecha = $receta->created_at;
                @endphp
                <span class="font-weight-bold text-primary">Publicado el :</span>
                <fecha-receta fecha='{{ $fecha }}' />
            </p>
            <div class="ingredinetes">
                <h2 class="my-3 text-center text-primary">Ingredientes</h2>
                {{-- parac inprimir un contenido html --}}
                {!! $receta->ingredientes !!}
                {{-- {{ $receta->ingredientes }} --}}
            </div>
            <div class="preparacion">
                <h2 class="text-center my-5 text-primary">Preparacion</h2>
                {!! $receta->preparacion !!}
            </div>
            <div class="justify-content-center row text-centerr">
                <like-button
                    id-receta="{{$receta->id}}"
                    like="{{$like}}"
                    likes="{{$likes}}"
                >
                </like-button>
            </div>
        </div>
    </article>
@endsection
