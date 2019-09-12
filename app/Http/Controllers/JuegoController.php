<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Respuesta;
use App\Jugador;

class JuegoController extends Controller
{
    public function test(Request $request)
    {


        //return 'A';
        $respuesta = Respuesta::find($request['respuesta']);

        //$pregunta = $respuesta->pregunta;

        $respuestas = $respuesta->pregunta->respuestas;
        //


        $jugador = Jugador::find($request['jugador']);
        //$puntajeJugador = $jugador->puntaje;

        if ($respuesta->correcta) {
            //dd(1);
            $jugador->sumarPunto();
        }


        // dd($respuesta->id);
        //return ['detalle' => $respuesta->detalle, 'correcta' => $respuesta->correcta, 'msg' => 'HOLA'];
        return compact('respuestas', 'respuesta', 'jugador');
    }


}