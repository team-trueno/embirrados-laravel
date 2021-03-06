<?php

namespace App;

use App\Role;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'apellido', 'usuario', 'avatar', 'fecha_nac', 'pais', 'email', 'password', 'activo',
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

    /**
     * Retrieve the model for a bound value.
     *
     * @param  mixed  $value
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function resolveRouteBinding($value)
    {
        return $this->where(function ($query) use ($value) {
            return $query->where('id', $value)->orWhere('usuario', $value);
        })->first() ?? abort(404);
    }

    public function jugador()
    {
        return $this->hasOne('App\Jugador', 'user_id');
    }

    public function perfil()
    {
        return $this->hasOne('App\Perfil', 'owner_id');
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class)->withTimestamps();
    }

    public function activar($activo = true)
    {
        $this->update(compact('activo'));
    }

    public function hacerAdmin($value = true)
    {
        if ($value) {
            $this->roles()->attach(Role::where('name', 'admin')->first());
            $this->perfil->hacerAdmin();
        } else {
            $this->roles()->detach(Role::where('name', 'admin')->first());
            $this->perfil->hacerJugador();
        }
    }

    public function sacarAdmin()
    {
        hacerAdmin(false);
    }

    public function desactivar()
    {
        $value = $this->activar(false);
        $this->update(compact('activo'));
    }

    public function authorizeRoles($roles)
    {
        abort_unless($this->hasAnyRole($roles), 401);
        return true;
    }

    public function hasAnyRole($roles)
    {
        if (is_array($roles)) {
            foreach ($roles as $role) {
                if ($this->hasRole($role)) {
                    return true;
                }
            }
        } else {
            if ($this->hasRole($roles)) {
                return true;
            }
        }
        return false;
    }

    public function hasRole($role)
    {
        if ($this->roles()->where('name', $role)->first()) {
            return true;
        }
        return false;
    }

    public function hasJugador()
    {
        if ($this->jugador()->first()) {
            return true;
        }
        return false;
    }
}
