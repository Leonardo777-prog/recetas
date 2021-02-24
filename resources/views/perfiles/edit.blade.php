@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.0/trix.css"
        integrity="sha512-EQF8N0EBjfC+2N2mlaH4tNWoUXqun/APQIuFmT1B+ThTttH9V1bA0Ors2/UyeQ55/7MK5ZaVviDabKbjcsnzYg=="
        crossorigin="anonymous" />
@endsection

@section('content')

    <h1 class="text-center">Editar mi perfil</h1>
{{$profile}}
    <div class="row justify-content-center mt2">
        <div class="col-md-10 bg-white p-3">
            <form action="{{ route('profiles.update',['profile'=> $profile->id]) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-grup">
                    <label for="name">Tu Nombre</label>
                    <input
                        type="text"
                        name="nombre"
                        class="form-control @error('name') is-invalid @enderror"
                        id="name"
                        value="{{$profile->user->name}}"
                    />

                    @error('nombre')
                        <span class="invalid-fedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-grup">
                    <label for="pageweb">Sitio Web</label>
                    <input
                        type="text"
                        name="pageweb"
                        class="form-control @error('pageweb') is-invalid @enderror"
                        id="pagweb"
                        value="{{$profile->user->pageweb}}"
                    />

                    @error('pageweb')
                        <span class="invalid-fedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="biografia">Biografia</label>
                    <input
                        type="hidden"
                        id="biografia"
                        name="biografia"
                        class="@error('biografia') is-invalid @enderror"
                        value="{{$profile->biografia}}"
                    />
                    
                    <trix-editor
                        input="biografia"
                        class="form-control @error('biografia') is-invalid @enderror"
                    />
                    </trix-editor>
                    @error('biografia')
                        <p>{{ $message }}</p>
                    @enderror
                </div>
                @if ($profile->imagen)
                    <div class="form-grup">
                        <p>Imagen actual:</p>
                        <img class="mw-100" src="{{ "/storage/{$profile->imagen}" }}" alt="">
                    </div>
                @endif
                
                <div class="form-grup">
                    <label for="imagen">Elige la imagen</label>
                    <input
                        type="file"
                        class="form-control @error('imagen') is-invalid @enderror"
                        name="imagen"
                    >
                        @error('imagen')
                            <p>{{ $message }}</p>
                        @enderror
                </div>
                <div class="form-grup">
                    <input type="submit" value="Actualizar Perfil" class="btn btn-primary mt-2">
                </div>
            </form>
        </div>
    </div>

@endsection
@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.0/trix.js"
        integrity="sha512-S9EzTi2CZYAFbOUZVkVVqzeVpq+wG+JBFzG0YlfWAR7O8d+3nC+TTJr1KD3h4uh9aLbfKIJzIyTWZp5N/61k1g=="
        crossorigin="anonymous" defer></script>
@endsection
