<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'profile_type',
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'perfiles';


    public function user()
    {
        return $this->belongsTo('App\User', 'owner_id');
    }

    public function isJugador()
    {
        return $this->profile_type === 'jugador';
    }

    public function isAdmin()
    {
        return $this->profile_type === 'admin';
    }

    public function isSuperAdmin()
    {
        return $this->profile_type === 'superadmin';
    }

    public function hacerJugador()
    {
        $this->update(['profile_type' => 'jugador']);
    }

    public function hacerAdmin()
    {
        $this->update(['profile_type' => 'admin']);
    }

}
