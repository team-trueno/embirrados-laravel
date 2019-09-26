<?php

namespace App\Http\Controllers;

use App\User;
use App\Role;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use PragmaRX\Countries\Package\Countries;

class UsuarioController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        auth()->user()->authorizeRoles(['admin', 'superadmin']);

        $sortBy = null;
        $role = auth()->user()->hasRole('superadmin');

        $usuarios = User::whereHas('perfil', function (Builder $query) use ($role) {
            $query->where('profile_type', 'jugador')
                ->orWhere('profile_type', 'admin')
                ->when($role, function ($query) {
                    return $query->orWhere('profile_type', 'superadmin');
                });
            })
            ->when($sortBy, function ($query, $sortBy) {
                return $query->orderBy($sortBy);
            }, function ($query) {
                return $query->orderBy('name');
            })
            ->paginate(10);

        return view('usuarios.index', compact('usuarios'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $paises = Countries::all()->pluck('name.common');
        return view('usuarios.create', compact('paises'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $mensajes = [
            'required' => 'El campo :attribute es obligatorio',
            'string' => 'El campo :attribute debe ser un texto',
            'max' => 'El campo :attribute debe tener un máximo de :max',
            'email' => 'Ingrese un :attribute en formato correcto',
            'unique' => 'El :attribute ya está tomado.',
            'before' => 'Debe ser mayor de edad',
        ];

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'usuario' => 'required|string|max:50|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'fecha_nac' => 'nullable|date|before:-18 years',
            'options' => 'required|in:jugador,admin',
        ], $mensajes);




        // $reglas = [
        //     'name' => ['string', 'max:255'],
        //     'apellido' => ['string', 'max:255'],
        //     'usuario' => ['string', 'max:255'],
        //     'avatar' => ['image'],
        //     'pais' => ['string', 'max:255'],
        //     'email' => ['string', 'email', 'max:255']
        // ];

        // $mensajes = [
        //     'string' => 'El campo :attribute debe ser un texto',
        //     'min' => 'El campo :attribute debe tener un minimo de :min',
        //     'max' => 'El campo :attribute debe tener un máximo de :max',
        //     'numeric' => 'El campo :attribute debe ser un numero',
        //     'integer' => 'El campo :attribute debe ser un número entero',
        //     'unique' => 'Este e-mail ya existe'
        // ];

        // $route = $request['avatar']->store('/public/img/avatars');

        // $fileName = basename($route);

        // $this->validate($request, $reglas, $mensajes);


        $usuario = User::create([
            'name' => Str::title($validatedData['name']),
            'apellido' => Str::title($validatedData['apellido']),
            'usuario' => $validatedData['usuario'],
            'fecha_nac' => $validatedData['fecha_nac'],
            'email' => $validatedData['email'],
            'password' => Hash::make('password'),
        ]);

        $usuario->jugador()->create();
        $usuario->perfil()->create([
            'profile_type' => $validatedData['options'],
        ]);

        $usuario->roles()->attach(Role::where('name', 'user')->first());

        if ($validatedData['options'] === 'admin') {
            $usuario->roles()->attach(Role::where('name', 'admin')->first());
        }

        //return (dd($usuario));
        return redirect()->route('usuarios.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $usuario)
    {

        // abort_unless(auth()->user()->id == $usuario->id, 403);
        //$userParam = 'admin';
        return view('usuarios.show', compact('usuario'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $usuario)
    {
        //$paises = Countries::all();

        $paises = Countries::all()->pluck('name.common');

        return view('usuarios.edit', compact('usuario', 'paises'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $usuario)
    {
        $reglas = [
            'name' => ['string', 'max:255'],
            'apellido' => ['string', 'max:255'],
            'usuario' => ['string', 'max:255', 'unique:users,usuario,'.$usuario->id],
            'avatar' => ['sometimes', 'image'],
            'pais' => ['string', 'max:255'],
            'fecha_nac' => 'required|date|before:-18 years',
            'email' => ['string', 'email', 'max:255', 'unique:users,email,'.$usuario->id],
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
            $fileName = $usuario->avatar;
        }


        $this->validate($request, $reglas, $mensajes);

        /**
         * Ver de pasar al otro formato de UPDATE
         */
        $usuario->update([
            'name' => $request['name'],
            'apellido' => $request['apellido'],
            'usuario' => $request['usuario'],
            'avatar' => $fileName,
            'fecha_nac' => $request['fecha_nac'],
            'pais' => $request['pais'],
            'email' => $request['email']
        ]);

        // $usuario->update();

        // $usuario->name = $request->name;
        // $usuario->apellido = $request->apellido;
        // $usuario->usuario = $request->usuario;
        // $usuario->avatar = $fileName;
        // $usuario->pais = $request->pais;
        // $usuario->email = $request->email;

        //$usuario->save();

        return redirect()->route('usuarios.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $usuario)
    {
        /**
         * El usuario no se borra, se desactiva
         * Si se desactiva el usuario, también hay que desactivar al jugador
         */
        // $usuario->delete();
        //dd($usuario);
        $usuario->desactivar();
        //dd($usuario->activo);
        return redirect()->route('usuarios.index');
    }
}
