<?php

namespace App\Providers;

use App\Categoria;
use Illuminate\Support\ServiceProvider;

class CategoriasProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // Colocamos las dependencias antes de que este listo 
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*', function ($view) {
            $categorias = Categoria::all();
            $view->with('categorias', $categorias);
        });
    }
}
