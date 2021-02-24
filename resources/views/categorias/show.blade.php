@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="titulo-categoria text-uppercase">{{ $nombre }}</h2>
        <div class="row">
            @foreach ($recetas as $receta)
                @include('ui.recetas')
            @endforeach
        </div>
    </div>
    <div class="d-flex justify-content-center">
        {{ $recetas->links() }}
    </div>
@endsection
