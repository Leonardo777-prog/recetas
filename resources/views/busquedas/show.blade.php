@extends('layouts.app')

@section('content')
    <h2 class="titulo-categoria text-uppercase">Reultados para: {{ $nombre }}</h2>
    @foreach ($recetas as $receta)
        @include('ui.recetas')
    @endforeach
    {{$recetas->links()}}
@endsection
