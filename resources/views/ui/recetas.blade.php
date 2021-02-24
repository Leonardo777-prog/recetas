<div class="col-md-4 my-5">
    <div class="card">
        <img src="/storage/{{ $receta->imagen }}" alt="Imagen receta" class="card-img-top">
        <div class="card-body">
            <h3>{{ $receta->titulo }}</h3>
            <div class="meta-receta d-flex justify-content-between">
                @php
                    $fecha = $receta->created_at;
                @endphp
                <p class="text-primary fecha">
                    {{-- <span class="font-weight-bold text-primary">Publicado el :</span> --}}
                    <fecha-receta fecha='{{ $fecha }}' />
                </p>
                <p>
                    {{count( $receta->like)}} le gusto
                </p>
            </div>
            <p>{{ Str::words(strip_tags($receta->preparacion), 16) }}</p>
            <a href="{{ route('recetas.show', ['receta' => $receta->id]) }}"
                class="btn btn-primary">Ver</a>
        </div>
    </div>
</div>