@extends('layouts.app')
@section('btn')
    <a href="{{ route('recetas.index') }}" class="btn btn-primary mr-2">Ir a inicio</a>
@endsection

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.0/trix.css"
        integrity="sha512-EQF8N0EBjfC+2N2mlaH4tNWoUXqun/APQIuFmT1B+ThTttH9V1bA0Ors2/UyeQ55/7MK5ZaVviDabKbjcsnzYg=="
        crossorigin="anonymous" />
@endsection
@section('content')
    <h2 class="text-center mb-5">Editar Receta: {{ $receta->titulo }}</h2>
    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <form method="post" action="{{ route('recetas.update', ['receta' => $receta->id]) }}" novalidate
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-grup">
                    <label for="titulo">Titulo de la Receta</label>
                    <input type="text" name="titulo" class="form-control @error('titulo') is-invalid @enderror" id="titulo"
                        placeholder="Titulo de la Receta" value="{{ $receta->titulo }}" />

                    @error('titulo')
                        <span class="invalid-fedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="categoria">Categoria</label>
                    <select class="form-control @error('categoria_id') is-invalid @enderror" name="categoria_id">
                        <option selected disabled>-Seleccione una Categoria-</option>
                        @foreach ($categorias as $categoria)
                            <option value="{{ $categoria->id }}"
                                {{ $receta->categoria_id == $categoria->id ? 'selected' : '' }}>{{ $categoria->nombre }}
                            </option>
                        @endforeach
                    </select>
                    @error('categoria_id')
                        <span class="invalid-fedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="preparacion">Preparacion</label>
                    <input type="hidden" id="preparacion" name="preparacion" value="{{ $receta->preparacion }}">
                    <trix-editor input="preparacion" class="form-control @error('preparacion') is-invalid @enderror">
                    </trix-editor>
                    @error('preparacion')
                        <p>{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="ingredientes">Ingredientes</label>
                    <input type="hidden" id="ingredientes" name="ingredientes"
                        class="@error('ingredientes') is-invalid @enderror" value="{{ $receta->ingredientes }}">
                    <trix-editor input="ingredientes" class="form-control @error('ingredientes') is-invalid @enderror">
                    </trix-editor>
                    @error('ingredientes')
                        <p>{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-grup">
                    <p>Imagen actual:</p>
                    <img class="mw-100" src="{{ "/storage/{$receta->imagen}" }}" alt="">
                </div>

                <div class="form-grup">
                    <label for="imagen">Elige la imagen</label>
                    <input type="file" class="form-control @error('imagen') is-invalid @enderror" name="imagen">
                    @error('imagen')
                        <p>{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-grup">
                    <input type="submit" value="Guardar Recta" class="btn btn-primary mt-2">
                </div>

            </form>
        </div>
    </div>
@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.0/trix.js"
        integrity="sha512-S9EzTi2CZYAFbOUZVkVVqzeVpq+wG+JBFzG0YlfWAR7O8d+3nC+TTJr1KD3h4uh9aLbfKIJzIyTWZp5N/61k1g=="
        crossorigin="anonymous" defer></script>
@endsection
@endsection
