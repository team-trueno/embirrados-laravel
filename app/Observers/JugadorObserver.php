<?php

namespace App\Observers;

use App\Jugador;
use App\Nivel;

class JugadorObserver
{
    /**
     * Handle the jugador "created" event.
     *
     * @param  \App\Jugador  $jugador
     * @return void
     */
    public function created(Jugador $jugador)
    {
        //
    }

    /**
     * Handle the jugador "updated" event.
     *
     * @param  \App\Jugador  $jugador
     * @return void
     */
    public function updated(Jugador $jugador)
    {
        if ($jugador->puntos >= $jugador->nivel->puntos_superar) {
            $next = Nivel::where('id', '>', $jugador->nivel->id)->orderBy('id')->first();
            $jugador->nivel()->associate($next);
            $jugador->save();
        }
    }

    /**
     * Handle the jugador "deleted" event.
     *
     * @param  \App\Jugador  $jugador
     * @return void
     */
    public function deleted(Jugador $jugador)
    {
        //
    }

    /**
     * Handle the jugador "restored" event.
     *
     * @param  \App\Jugador  $jugador
     * @return void
     */
    public function restored(Jugador $jugador)
    {
        //
    }

    /**
     * Handle the jugador "force deleted" event.
     *
     * @param  \App\Jugador  $jugador
     * @return void
     */
    public function forceDeleted(Jugador $jugador)
    {
        //
    }
}
