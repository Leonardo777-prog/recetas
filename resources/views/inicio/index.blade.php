@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"
        integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g=="
        crossorigin="anonymous" />
@endsection

@section('content')

@section('hero')
    <div class="hero-categorias">
        <form class="container h-100" action="{{ route('buscar.show') }}">
            <div class="row h-100 align-items-center">
                <div class="col-md-4 texto-buscar">
                    <p>Encuentra Una Receta Para tu Proxima Comida</p>
                    <input
                        type="search"
                        name="buscar"
                        class="form-control"
                        placeholder="Buscar Receta"
                    >
                </div>
            </div>
        </form>
    </div>
@endsection
{{-- <img src="{{ asset('images/bgimagen.jpg') }}" alt="Imagen de Fondo" class="w-100"> --}}

    <div class="container nuevas-recetas">
        <h2 class="titulo-categoria text-uppercase">Ultimas Recetas</h2>
        <div class="owl-carousel owl-theme">
            @foreach ($recetas as $receta)
                <div class="card">
                    <img src="/storage/{{ $receta->imagen }}" alt="Imagen receta" class="card-img-top">
                    <div class="card-body">
                        <h3>{{ $receta->titulo }}</h3>
                        <p>{{ Str::words(strip_tags($receta->preparacion), 16) }}</p>
                        <a href="{{ route('recetas.show', ['receta' => $receta->id]) }}" class="btn btn-primary">Ver</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="container">
        <h2 class="titulo-categoria text-uppercase">Recetas Mas votadas</h2>
        <div class="row">
            @foreach ($votadas as $receta)
                  @include('ui.recetas')
            @endforeach
        </div>
    </div>

    @foreach ($recetasCategorias as $key => $grupo)
        <div class="container">
            <h2 class="titulo-categoria text-uppercase">{{ str_replace('-', ' ', $key) }}</h2>
            <div class="row">
                @foreach ($grupo as $recetas)
                    @foreach ($recetas as $receta)
                      @include('ui.recetas')
                    @endforeach
                @endforeach
            </div>
        </div>
    @endforeach

@endsection
