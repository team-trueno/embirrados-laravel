<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use PragmaRX\Countries\Package\Countries;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        $paises = Countries::all();

        $paises = Countries::all()->pluck('name.common');

        return view('auth.register', compact('paises'));
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'apellido' => ['required', 'string', 'max:255'],
            'usuario' => ['required', 'string', 'max:255', 'unique:users'],
            'avatar' => ['required', 'image'],
            'fecha_nac' => ['required', 'date', 'before:-18 years'],
            'pais' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'acepto' => ['accepted'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $route = $data['avatar']->store('/public/img/avatars');

        $fileName = basename($route);

        $user = User::create([
            'name' => $data['name'],
            'apellido' => $data['apellido'],
            'usuario' => $data['usuario'],
            'avatar' => $fileName,
            'fecha_nac' => $data['fecha_nac'],
            'pais' => $data['pais'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        $user->jugador()->create();
        $user->perfil()->create([
            'profile_type' => 'jugador',
        ]);

        $user->roles()->attach(Role::where('name', 'user')->first());

        return $user;
    }
}
