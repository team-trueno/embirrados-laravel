<?php

namespace App\Http\Controllers;

use App\Perfil;
use App\User;
use Illuminate\Http\Request;

class PerfilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //return dd($user);
        return view('perfiles.show', [
            'usuario' => $user,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('perfiles.edit', [
            'usuario' => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $reglas = [
            'name' => ['string', 'max:255'],
            'apellido' => ['string', 'max:255'],
            'usuario' => ['sometimes'|'required'|'string', 'max:255'|'unique:users'],
            'email' => ['sometimes'|'required'|'string'|'email'|'max:255'|'unique:users'],
            'fecha_nac' => ['nullable'|'date'|'before:-18 years']
        ];

        $mensajes = [
            'string' => 'El campo :attribute debe ser un texto',
            'min' => 'El campo :attribute debe tener un minimo de :min',
            'max' => 'El campo :attribute debe tener un máximo de :max',
            'numeric' => 'El campo :attribute debe ser un numero',
            'integer' => 'El campo :attribute debe ser un número entero'
        ];

        $route = $request['avatar']->store('/public/img/avatars');

        $fileName = basename($route);

        $this->validate($request, $reglas, $mensajes);

        $user->update([
            'name' => $request['name'],
            'apellido' => $request['apellido'],
            'usuario' => $request['usuario'],
            'email' => $request['email'],
            'fecha_nac' => $request['fecha_nac']
        ]);

        // redirigir hacia el perfil del usuario
        return redirect()->route('perfiles.show', auth()->user()->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function destroy(Perfil $perfil)
    {
        //
    }
}
