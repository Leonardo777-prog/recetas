<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    // Son los campos que vamos a agregar a la base de datos
    protected $fillable = [
        'name', 'email', 'password', 'pageweb'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // eventos que se ejeccuta cuando un user es creado
    protected static function boot()
    {
        parent::boot();
        // asiganar perfil una ves se cree un usuartoio
        static::created(function ($user) {
            $user->perfil()->create();
        });
    }

    // relacion de uno a mucho de Usuarios a Recetas
    public function recetas()
    {
        return $this->hasMany(Receta::class);
    }

    public function perfil()
    {
        return $this->hasOne(Profile::class);
    }

    public function meGusta()
    {
        return $this->belongsToMany(Receta::class,'likes_recetas');
    }
}
