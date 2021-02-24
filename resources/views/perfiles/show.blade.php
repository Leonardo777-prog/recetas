@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <img src="{{"/storage/$profile->imagen"}}" class="w-100 rounded-circle" alt="Perfil">
            </div>
            <div class="col-md-5">
                <h2 class="text-center mb-2 text-primary">{{ $profile->user->name }}</h2>
                <a href="">Ir a Google</a>
                <div class="biografia">
                    {!! $profile->biografia !!}
                </div>
            </div>
        </div>
    </div>
    <h2 class="text-center my-5">{{"Recetas creadas por {$profile->user->name}"}}</h2>
    <div class="container">
        <div class="row mx-auto bg-white p-4">
            @if(count($recetas) > 0)
                @foreach ($recetas as $receta)
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <img src="/storage/{{$receta->imagen}}" alt="" class="card-img-top">
                            <div class="card-body">
                                <h3>{{$receta->titulo}}</h3>
                                <a href="{{ route('recetas.show', ['receta' => $receta->id]) }}" class="btn btn-primary d-block">Ver Receta</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <p class="text-center col-12 w-100">No se an creado recetas todavia</p>
            @endif
        </div>
    </div>
    <div class="col-12 mt-2 justify-content-center d-flex">
        {{$recetas->links()}}
    </div>
@endsection
