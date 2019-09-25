@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8">
            @component('components.card')
            @slot('header')
                Nuevo usuario
            @endslot

            <div class="card-body">
                <form method="POST" action="{{ route('usuarios.store') }}">
                    @csrf

                    <div class="form-group row">
                        <label for="name" class="col-12 col-sm-3 col-form-label text-sm-right">
                            {{ __('Nombre') }}
                        </label>

                        <div class="col-12 col-sm-9 col-lg-9">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                name="name" value="{{ old('name') }}" {{-- required --}} autocomplete="name" autofocus>

                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="apellido"
                            class="col-12 col-sm-3 col-form-label text-sm-right">{{ __('Apellido') }}</label>

                        <div class="col-12 col-sm-9 col-lg-9">
                            <input id="apellido" type="text"
                                class="form-control @error('apellido') is-invalid @enderror" name="apellido"
                                value="{{ old('apellido') }}" {{-- required --}} autocomplete="apellido">

                            @error('apellido')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email"
                            class="col-12 col-sm-3 col-form-label text-sm-right">{{ __('E-mail') }}</label>

                        <div class="col-12 col-sm-9 col-lg-9">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" {{-- required --}} autocomplete="email">

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="usuario"
                            class="col-12 col-sm-3 col-form-label text-sm-right">{{ __('Usuario') }}</label>

                        <div class="col-12 col-sm-9 col-lg-9">
                            <input id="usuario" type="text" class="form-control @error('usuario') is-invalid @enderror"
                                name="usuario" value="{{ old('usuario') }}" {{-- required --}} autocomplete="usuario">

                            @error('usuario')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="fecha_nac"
                            class="col-12 col-sm-3 col-form-label text-sm-right">{{ __('Fecha de Nacimiento') }}</label>

                        <div class="col-12 col-sm-9 col-lg-9">
                            <input id="fecha_nac" type="date"
                                class="form-control @error('fecha_nac') is-invalid @enderror" name="fecha_nac"
                                value="{{ old('fecha_nac') }}" autocomplete="fecha_nac">

                            @error('fecha_nac')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    {{-- no mantiene seleccionado el pais que tenia el usuario antes de editar sus datos --}}
                    <div class="form-group row">
                        <label for="pais" class="col-12 col-sm-3 col-form-label text-sm-right">{{ __('País') }}</label>

                        <div class="col-12 col-sm-9 col-lg-9">
                            <select id="pais" class="form-control @error('pais') is-invalid @enderror" name="pais"
                                {{-- required --}}>
                                @foreach ($paises as $pais)
                                <option value="{{ old('pais') }}" {{ $pais == old('pais') ? "selected" : "" }}>
                                    {{ $pais }}
                                </option>
                                @endforeach

                            </select>
                            @error('pais')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="options" class="col-12 col-sm-3 col-form-label text-sm-right">{{ __('Tipo perfil') }}</label>
                        <div class="col-12 col-sm-9 col-lg-9 btn-group-toggle" data-toggle="buttons">
                            <label class="btn btn-outline-secondary active">
                                <input type="radio" name="options" id="option1" autocomplete="off" value="jugador" checked> Jugador
                            </label>
                            <label class="btn btn-outline-secondary">
                                <input type="radio" name="options" id="option2" autocomplete="off" value="admin"> Admin
                            </label>
                            @error('options')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row mb-0 float-right">
                        <div class="col">
                            <button type="submit" class="btn btn-warning">
                                    {{ __('Guardar') }}
                            </button>

                            <a href="{{ route('usuarios.index') }}" class="btn btn-dark">Atrás</a>
                        </div>
                    </div>
                </form>
            </div>
            @endcomponent
        </div>
    </div>
</div>
@endsection
