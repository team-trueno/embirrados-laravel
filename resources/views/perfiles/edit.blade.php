@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row mb-4 justify-content-center">
        <div class="col-12 col-md-8">
            @component('components.card')
                @slot('header')
                    Actualiza tus datos
                @endslot

                <div class="card-body">
                    <form method="POST" action="{{ action('PerfilController@update', $usuario->id) }}" role="form" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <div class="form-group row">
                            <label for="name" class="col-12 col-sm-3 col-form-label text-sm-right">
                                {{ __('Nombre del Usuario') }}
                            </label>

                            <div class="col-12 col-sm-9 col-lg-9">
                                <input id="name" type="text"
                                    class="form-control @error('name') is-invalid @enderror" name="name"
                                    value="{{ $usuario->name }}" required autocomplete="name" autofocus>

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
                                    value="{{$usuario->apellido}}" required autocomplete="apellido">

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
                                <input id="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{$usuario->email}}" required autocomplete="email">

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
                                <input id="usuario" type="text"
                                    class="form-control @error('usuario') is-invalid @enderror" name="usuario"
                                    value="{{$usuario->usuario}}" required autocomplete="usuario">

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
                                    value="{{ $usuario->fecha_nac }}" required autocomplete="fecha_nac">

                                @error('fecha_nac')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                                <label for="avatar" class="col-12 col-sm-3 col-form-label text-sm-right">{{ __('Avatar') }}</label>

                                <div class="col-12 col-sm-9 col-lg-9">
                                <input id="avatar" type="file" class="form-control-file @error('avatar') is-invalid @enderror" name="avatar" value="{{ asset('storage/img/avatars/'.$usuario->avatar) }}">

                                    @error('avatar')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                    <label for="pais" class="col-12 col-sm-3 col-form-label text-sm-right">{{ __('País') }}</label>

                                    <div class="col-12 col-sm-9 col-lg-9">
                                        <select id="pais" class="form-control @error('pais') is-invalid @enderror" name="pais" required>
                                            <option value="" disabled selected hidden>Seleccione...</option>
                                            @foreach ($paises as $pais)
                                            <option value="{{ $pais }}" {{ $pais == $usuario->pais ? "selected" : "" }}>
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

                        <div class="form-group row mb-0 float-right">
                            <div class="col">
                                <button type="submit" class="btn btn-info">
                                    {{ __('Actualizar') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            @endcomponent
        </div>
    </div>
</div>
@endsection
