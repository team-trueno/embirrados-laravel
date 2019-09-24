@extends('layouts.master')
@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-12 col-md-8">
            <div class="card mb-4">
            <div class="card-header"><h3>{{$usuario->name}} {{$usuario->apellido}}</h3></div>
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
                                @if ($usuario->hasJugador())
                                <span class="btn btn-dark btn-lg">{{ $usuario->jugador->nivel->nombre }}</span>
                                <span class="btn btn-secondary btn-lg">Puntos <span class="badge badge-light">{{ $usuario->jugador->puntos }}</span></span>
                                @endif
        
                            </li>
                            <li class="list-group-item">{{ $usuario->email }}</li>
                            <li class="list-group-item">{{ $usuario->usuario }}</li>
                            <li class="list-group-item">{{ $usuario->pais }}</li>
                        </ul>
                        <div class="card-body">
                            <a class="btn btn-warning" href="{{ route('usuarios.edit', $usuario->id) }}"><i class="fas fa-edit d-lg-none"></i><span class="d-none d-lg-block">Editar</span></a>
                            @if ($usuario->activo)
                            <form id="form" class="d-inline" action="{{ route('perfiles.destroy', $usuario->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
        
                                <button class="btn btn-danger" type="submit"><i class="fas fa-trash-alt d-lg-none"></i><span class="d-none d-lg-block">Desactivar</span></button>
                            </form>
                            @else
                            <form class="d-inline" action="{{ route('perfiles.store', $usuario->id) }}" method="POST">
                                @csrf
        
                                <button class="btn btn-success" type="submit"><i class="fas fa-trash-alt d-lg-none"></i><span class="d-none d-lg-block">Activar</span></button>
                            </form>
                            @endif
                            @if (auth()->user()->hasRole('superadmin'))
        
        
                            @if ($usuario->hasRole('admin'))
                            <form id="form" class="d-inline" action="{{ route('admin.destroy', $usuario->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
        
                                <button class="btn btn-danger" type="submit"><i class="fas fa-trash-alt d-lg-none"></i><span class="d-none d-lg-block">DesAdmin</span></button>
                            </form>
                            @else
                            <form class="d-inline" action="{{ route('admin.store', $usuario->id) }}" method="POST">
                                @csrf
        
                                <button class="btn btn-success" type="submit"><i class="fas fa-trash-alt d-lg-none"></i><span class="d-none d-lg-block">Adminear</span></button>
                            </form>
                            @endif
                            @endif
        
                        </div>
                </div>
            </div>

            @if ($usuario->hasRole('user'))
                <div class="card mb-4">
                    <div class="card-header"><h3>Acciones</h3></div>
                    <div class="card-body">
                            @if ($usuario->hasJugador())
                                <p class="lead text-center">
                                    <a class="btn btn-warning btn-lg align-items-center" href="/juego" role="button">¡Jugar ahora!</a>
                                    <a class="btn btn-success btn-lg align-items-center" href="/ranking" role="button">Ver ranking</a>
                                    <a class="btn btn-danger btn-lg align-items-center" href="#" role="button">Desactivar mi perfil</a>
                                </p>
                            
                            @else
                                <p class="lead text-center">
                                    <a class="btn btn-danger btn-lg align-items-center" href="#" role="button">Administrar usuarios</a>
                                    <button class="btn btn-warning btn-lg align-items-center" disabled="disabled">¡Jugar ahora!</button>
                                </p>
                            @endif
                    </div>
                </div>
            @endif
        </div>

    </div>
</div>
@endsection
