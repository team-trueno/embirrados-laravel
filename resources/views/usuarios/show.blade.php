@extends('layouts.master')
@section('js')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-12 col-md-4">
            <div class="card mb-4">
                {{-- <div> --}}
                    <img src="{{ asset('storage/img/avatars/'.$usuario->avatar) }}" class="card-img-top">
                {{-- </div> --}}
                <div class="card-body text-center">
                    <h3 class="card-title">{{$usuario->name}} {{$usuario->apellido}}</h3>
                    <div class="">
                            @switch($usuario->perfil->profile_type)
                            @case('superadmin')
                                <button type="button" class="btn btn-success btn-sm btn-block">
                                    {{-- <i class="fas fa-crown d-lg-none"></i> --}}
                                    <span class="text-uppercase d-block">{{ $usuario->perfil->profile_type }}</span>
                                </button>

                                @break
                            @case('admin')
                                <button type="button" class="btn btn-danger btn-sm btn-block">
                                    {{-- <i class="fas fa-user-cog d-lg-none"></i> --}}
                                    <span class="text-uppercase d-block">{{ $usuario->perfil->profile_type }}</span>
                                </button>

                                @break
                            @default
                                <button type="button" class="btn btn-secondary btn-sm btn-block">
                                    {{-- <i class="fas fa-gamepad d-lg-none"></i> --}}
                                    <span class="text-uppercase d-block">{{ $usuario->perfil->profile_type }}</span>
                                </button>

                        @endswitch

                    @if ($usuario->activo)
                        <span class="btn btn-success btn-sm text-uppercase btn-block">Activo</span>
                    @else
                        <span class="btn btn-danger btn-sm text-uppercase btn-block">Inactivo</span>
                    @endif
                </div>

                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item text-center">
                        @if ($usuario->hasJugador())
                        <div class="d-flex">
                        <span class="btn btn-dark btn-lg w-50 mr-1">{{ $usuario->jugador->nivel->nombre }}</span>
                        <span class="btn btn-secondary btn-lg w-50">Puntos <span class="badge badge-light">{{ $usuario->jugador->puntos }}</span></span>
                        </div>
                        @endif

                    </li>
                    <li class="list-group-item"><span class="text-muted">Email: </span>{{ $usuario->email ? $usuario->email : 'N/D' }}</li>
                    <li class="list-group-item"><span class="text-muted">Usuario: </span>{{ $usuario->usuario ? $usuario->usuario : 'N/D' }}</li>
                    {{-- Estaría bueno meter la banderita del país acá --}}
                    <li class="list-group-item"><span class="text-muted">Pais: </span>{{ $usuario->pais ? $usuario->pais : 'N/D' }}</li>
                </ul>
                <div class="card-body">
                    <div>
                    <a class="btn btn-warning btn-block mb-2" href="{{ route('usuarios.edit', $usuario->id) }}"><span class="d-block">Editar</span></a>
                    @if ($usuario->activo)
                    <form id="form" class="d-block mb-2" action="{{ route('perfiles.destroy', $usuario->id) }}" method="POST">
                        @csrf
                        @method('DELETE')

                        {{-- Acá hay que meter un Modal/Alert que pida confirmacion antes de enviar --}}
                        <button class="btn btn-danger btn-block" type="submit"><span class="d-block">Desactivar</span></button>
                    </form>
                    @else
                    <form class="d-inline d-block" action="{{ route('perfiles.store', $usuario->id) }}" method="POST">
                        @csrf

                        {{-- Acá hay que meter un Modal/Alert que pida confirmacion antes de enviar --}}
                        <button class="btn btn-success btn-block" type="submit"><span class="d-block">Activar</span></button>
                    </form>
                    @endif
                    @if (auth()->user()->hasRole('superadmin'))

@if (! $usuario->hasRole('superadmin'))


                    @if ($usuario->hasRole('admin'))
                    <form id="form" class="d-inline d-block" action="{{ route('admin.destroy', $usuario->id) }}" method="POST">
                        @csrf
                        @method('DELETE')

                        {{-- Acá hay que meter un Modal/Alert que pida confirmacion antes de enviar --}}
                        <button class="btn btn-danger btn-block" type="submit"><span class="d-block">DesAdmin</span></button>
                    </form>
                    @else
                    <form class="d-inline" action="{{ route('admin.store', $usuario->id) }}" method="POST">
                        @csrf

                        {{-- Acá hay que meter un Modal/Alert que pida confirmacion antes de enviar --}}
                        <button class="btn btn-success btn-block" type="submit"><span class="d-block">Adminear</span></button>
                    </form>
                    @endif
                    @endif
                    @endif
                </div>

                </div>
            </div>
        </div>

        <div class="col-12 col-md-8">
                <div class="row mb-4 justify-content-center">
                        <div class="col-12">
            @component('components.card')
                @slot('header')
                    Datos del usuario
                @endslot

                <div class="card-body">
                    <form>
                    <fieldset disabled="disabled">
                        <div class="form-group row">
                            <label for="detalle[]" class="col-12 col-sm-3 col-form-label text-sm-right">
                                {{ __('Nombre') }}
                            </label>

                            <div class="col-12 col-sm-9 col-lg-9">
                                <input type="text" class="form-control" value="{{ $usuario->name }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="detalle[]" class="col-12 col-sm-3 col-form-label text-sm-right">
                                {{ __('Apellido') }}
                            </label>

                            <div class="col-12 col-sm-9 col-lg-9">
                                <input type="text" class="form-control" value="{{ $usuario->apellido }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="detalle[]" class="col-12 col-sm-3 col-form-label text-sm-right">
                                {{ __('Email') }}
                            </label>

                            <div class="col-12 col-sm-9 col-lg-9">
                                <input type="text" class="form-control" value="{{ $usuario->email }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="detalle[]" class="col-12 col-sm-3 col-form-label text-sm-right">
                                {{ __('Usuario') }}
                            </label>

                            <div class="col-12 col-sm-9 col-lg-9">
                                <input type="text" class="form-control" value="{{ $usuario->usuario }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="detalle[]" class="col-12 col-sm-3 col-form-label text-sm-right">
                                {{ __('Fecha de nacimiento') }}
                            </label>

                            <div class="col-12 col-sm-9 col-lg-9">
                                <input type="text" class="form-control" value="{{ $usuario->fecha_nac }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="detalle[]" class="col-12 col-sm-3 col-form-label text-sm-right">
                                {{ __('País') }}
                            </label>

                            <div class="col-12 col-sm-9 col-lg-9">
                                <input type="text" class="form-control" value="{{ $usuario->pais }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="options" class="col-12 col-sm-3 col-form-label text-sm-right">
                                {{ __('Tipo perfil') }}
                            </label>
                            {{-- {{dd($usuario->perfil->isJugador())}} --}}

                            <div class="col-12 col-sm-9 col-lg-9 btn-group-toggle">
                                <label class="btn btn-outline-secondary mb-1 mb-sm-0 mr-sm-1 d-block d-sm-inline-block {{ $usuario->perfil->isJugador() ? "active" : "disabled" }}">
                                    <input type="radio" name="options" id="option1" autocomplete="off" value="jugador"> Jugador
                                </label>
                                <label class="btn btn-outline-danger mb-1 mb-sm-0 mr-sm-1 d-block d-sm-inline-block {{ $usuario->perfil->isAdmin() ? "active" : "disabled" }}">
                                    <input type="radio" name="options" id="option2" autocomplete="off" value="admin"> Admin
                                </label>
                                <label class="btn btn-outline-success d-block d-sm-inline-block {{ $usuario->perfil->isSuperAdmin() ? "active" : "disabled" }}">
                                    <input type="radio" name="options" id="option3" autocomplete="off" value="superadmin"> Superadmin
                                </label>
                            </div>
                        </div>
                    </fieldset>
                    </form>
                </div>
            @endcomponent
                        </div>
                        </div>

                        @if ($usuario->hasJugador())
            <div class="row mb-4 justify-content-center">
                    <div class="col-12">
            @component('components.card')
                @slot('header')
                    Estadisticas del jugador
                @endslot

                <div class="card-body">
                    <div class="form">
                        <div class="form-group row">
                            <label for="detalle[]" class="col-12 col-sm-3 col-form-label text-sm-right">
                                {{ __('Nivel') }}
                            </label>

                            <div class="col-12 col-sm-9 col-lg-9">
                                <span class="btn btn-primary d-block d-sm-inline-block">{{ $usuario->jugador->nivel->nombre }}</span>
                                {{-- <input type="text" class="form-control" value="{{ $usuario->name }}"> --}}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="detalle[]" class="col-12 col-sm-3 col-form-label text-sm-right">
                                {{ __('Puntos') }}
                            </label>

                            <div class="col-12 col-sm-9 col-lg-9">
                                <span class="btn btn-primary d-block d-sm-inline-block">{{ $usuario->jugador->puntos }}</span>
                                {{-- <input type="text" class="form-control" value="{{ $usuario->name }}"> --}}
                            </div>
                        </div>
                    </div>
                </div>

            @endcomponent
            @endif


        </div>
        </div>
        </div>


        </div>

    </div>
</div>

{{-- <script>
    $(document).ready(function(){
        $('#form').submit(function(e) {
            e.preventDefault();
            var form = $(this);
            var url = form.attr('action');

            $.ajax({
                type: "POST",
                url: url,
                data: form.serialize(), // serializes the form's elements.
                success: function(data)
                {
                    console.log('Completado');
                    // alert(data); // show response from the php script.
                }
         });
        });
    });
</script> --}}
@endsection
