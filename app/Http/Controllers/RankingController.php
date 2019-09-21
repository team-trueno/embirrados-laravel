<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jugador;
use Illuminate\Database\Eloquent\Builder;

class RankingController extends Controller
{
    public function index()
    {
        $jugadores = Jugador::whereHas('user.perfil', function (Builder $query) {
            $query->where('profile_type', 'jugador');
        })->orderBy('puntos', 'DESC')->get();
        // $jugadores = Jugador::orderBy('puntos', 'DESC')->paginate(15);
        // $usuarios = User::paginate(15);
        return view('ranking', compact('jugadores'));
    }
}
