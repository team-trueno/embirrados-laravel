<?php

namespace App\Http\Controllers;

use App\Perfil;
use App\User;
use PragmaRX\Countries\Package\Countries;
use Illuminate\Http\Request;

class PerfilController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware ('auth')->except(['show']);
    }

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
        abort_unless(auth()->user()->id == $user->id, 403);

        $paises = Countries::all()->pluck('name.common');

        return view('perfiles.edit', [
            'usuario' => $user,
            'paises' => $paises,
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
        abort_unless(auth()->user()->id == $user->id, 403);

        $reglas = [
            'name' => ['string', 'max:255'],
            'apellido' => ['string', 'max:255'],
            'usuario' => ['string', 'max:255', 'unique:users,usuario,'.$user->id],
            'avatar' => ['sometimes', 'image'],
            'pais' => ['string', 'max:255'],
            'fecha_nac' => 'required|date|before:-18 years',
            'email' => ['string', 'email', 'max:255', 'unique:users,email,'.$user->id],
        ];

        $mensajes = [
            'string' => 'El campo :attribute debe ser un texto',
            'min' => 'El campo :attribute debe tener un minimo de :min',
            'max' => 'El campo :attribute debe tener un máximo de :max',
            'numeric' => 'El campo :attribute debe ser un numero',
            'integer' => 'El campo :attribute debe ser un número entero',
            'unique' => 'El :attribute ya está tomado.',
            'before' => 'Debe ser mayor de edad',
        ];

        if ($request['avatar']) {
            # code...
            $route = $request['avatar']->store('/public/img/avatars');
            $fileName = basename($route);
        } else {
            $fileName = $user->avatar;
        }


        $this->validate($request, $reglas, $mensajes);

        /**
         * Ver de pasar al otro formato de UPDATE
         */
        $user->update([
            'name' => $request['name'],
            'apellido' => $request['apellido'],
            'usuario' => $request['usuario'],
            'avatar' => $fileName,
            'fecha_nac' => $request['fecha_nac'],
            'pais' => $request['pais'],
            'email' => $request['email']
        ]);

        return redirect()->action('PerfilController@show', $user->id);
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
