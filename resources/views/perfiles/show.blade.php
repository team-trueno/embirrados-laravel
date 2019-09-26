@extends('layouts.master')
@section('content')
<div class="container">
    <div class="row mb-4 justify-content-center">

        @if (auth()->check() && (auth()->user()->id === $usuario->id))
            
        <div class="col-12 col-md-8">

            @component('components.card')
                @slot('header')
                {{ $usuario->usuario }}
                @endslot

                <div class="card-body">
                        <img src="{{ asset('storage/img/avatars/'.$usuario->avatar) }}" class="card-img-top">
                        <div class="card-body text-center">
                            @if ($usuario->hasRole('admin'))
                                <span class="btn btn-danger btn-sm text-uppercase">Admin</span>
                            @else
                                <span class="btn btn-warning btn-sm text-uppercase">Jugador</span>
                            @endif
        
                            @if ($usuario->activo)
                                <span class="btn btn-success btn-sm text-uppercase">Activo</span>
                            @else
                                <span class="btn btn-danger btn-sm text-uppercase">Inactivo</span>
                            @endif
        
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item text-center">
                                @if($usuario->hasRole('superadmin'))
                                <span class="btn btn-dark btn-lg">SUPERADMIN</span>
                                @else
                                <span class="btn btn-dark btn-lg">{{ $usuario->jugador->nivel->nombre }}</span>
                                <span class="btn btn-secondary btn-lg">Puntos <span class="badge badge-light">{{ $usuario->jugador->puntos }}</span></span>
                                @endif
                                
                            </li>
                            <li class="list-group-item">{{ $usuario->name }} {{$usuario->apellido}}</li>
                            <li class="list-group-item">{{ $usuario->email }}</li>
                            <li class="list-group-item">{{ $usuario->pais }}</li>
                        </ul>
                        <div class="card-body">
                            <a class="btn btn-info" href="{{ route('usuarios.edit', $usuario->id) }}">Modificar mis datos</a>    
                        </div>
                </div>
                @endcomponent

            @if ($usuario->hasRole('user'))
                @component('components.card')
                    @slot('header')
                        Acciones
                    @endslot
                    <div class="card-body">
                            @if ($usuario->hasRole('admin') && $usuario->hasJugador())
                            <p class="lead text-center">
                                <a class="btn btn-success btn-lg align-items-center" href="#" role="button">Ir al Dashboard</a>
                                <a class="btn btn-warning btn-lg align-items-center" href="/juego" role="button">¡Jugar ahora!</a>
                                
                            </p>

                            @elseif($usuario->hasRole('admin') || $usuario->hasRole('superadmin'))
                            <p class="lead text-center">
                                <a class="btn btn-success btn-lg align-items-center" href="#" role="button">Ir al Dashboard</a>
                                <button class="btn btn-warning btn-lg align-items-center" disabled="disabled">¡Jugar ahora!</button>
                            </p>
                            
                            @else
                            <p class="lead text-center">
                                <a class="btn btn-warning btn-lg align-items-center" href="/juego" role="button"><i class="fas fa-gamepad d-lg-none"></i><span class="d-none d-lg-block">¡Jugar ahora!</span></a>
                                <a class="btn btn-success btn-lg align-items-center" href="/ranking" role="button"><i class="fas fa-list-ol d-lg-none"></i><span class="d-none d-lg-block">Ver ranking</span></a>
                                <a class="btn btn-danger btn-lg align-items-center" href="#" role="button"><i class="fas fa-user-slash d-lg-none"></i><span class="d-none d-lg-block">Desactivar mi perfil</span></a>
                            </p>
                                
                            @endif
                    </div>
                @endcomponent
            @endif


        @elseif(auth()->check() || (auth()->user()->id =! $usuario->id))

        <div class="col-12 col-md-8">

                @component('components.card')
                    @slot('header')
                        {{ $usuario->usuario }}
                    @endslot
                    <div class="card-body">
                            <img src="{{ asset('storage/img/avatars/'.$usuario->avatar) }}" class="card-img-top">
                            <div class="card-body text-center">
                                @if ($usuario->hasRole('admin'))
                                    <span class="btn btn-danger btn-sm text-uppercase">Admin</span>
                                @else
                                    <span class="btn btn-warning btn-sm text-uppercase">Jugador</span>
                                @endif
            
                                @if ($usuario->activo)
                                    <span class="btn btn-success btn-sm text-uppercase">Activo</span>
                                @else
                                    <span class="btn btn-danger btn-sm text-uppercase">Inactivo</span>
                                @endif            
                            </div>

                            <ul class="list-group list-group-flush">
                                <li class="list-group-item text-center">
                                    @if($usuario->hasRole('superadmin'))
                                    <span class="btn btn-dark btn-lg">SUPERADMIN</span>
                                    @else
                                    <span class="btn btn-dark btn-lg">{{ $usuario->jugador->nivel->nombre }}</span>
                                    <span class="btn btn-secondary btn-lg">Puntos <span class="badge badge-light">{{ $usuario->jugador->puntos }}</span></span>
                                    @endif                                    
                                </li>
                                <li class="list-group-item">{{$usuario->name}} {{$usuario->apellido}}</li>
                                <li class="list-group-item">{{ $usuario->email }}</li>
                                <li class="list-group-item">{{ $usuario->pais }}</li>
                            </ul>
                    </div>
                @endcomponent
        </div>
                
        </div>

        @endif

    </div>
</div>
@endsection
