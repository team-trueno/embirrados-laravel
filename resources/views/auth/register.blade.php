@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-md-9">
            <div class="card">
                <div class="card-header">{{ __('Formulario de Registro') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-12 col-sm-3 col-form-label text-md-right">{{ __('Nombre') }}</label>

                            <div class="col-12 col-sm-9">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="apellido" class="col-12 col-sm-3 col-form-label text-md-right">{{ __('Apellido') }}</label>

                            <div class="col-12 col-sm-9">
                                <input id="apellido" type="text" class="form-control @error('apellido') is-invalid @enderror" name="apellido" value="{{ old('apellido') }}" required autocomplete="apellido">

                                @error('apellido')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="usuario" class="col-12 col-sm-3 col-form-label text-md-right">{{ __('Usuario') }}</label>

                            <div class="col-12 col-sm-9">
                                <input id="usuario" type="text" class="form-control @error('usuario') is-invalid @enderror" name="usuario" value="{{ old('usuario') }}" required autocomplete="usuario">

                                @error('usuario')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="avatar" class="col-12 col-sm-3 col-form-label text-md-right">{{ __('Avatar') }}</label>

                            <div class="col-12 col-sm-9">
                                <input id="avatar" type="file" class="form-control @error('avatar') is-invalid @enderror" name="avatar" value="{{ old('avatar') }}" required autocomplete="avatar" autofocus>

                                @error('avatar')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="fecha_nac" class="col-12 col-sm-3 col-form-label text-md-right">{{ __('Fecha de Nacimiento') }}</label>

                            <div class="col-12 col-sm-9">
                                <input id="fecha_nac" type="date" class="form-control @error('fecha_nac') is-invalid @enderror" name="fecha_nac" value="{{ old('fecha_nac') }}" required autocomplete="fecha_nac">

                                @error('fecha_nac')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="pais" class="col-12 col-sm-3 col-form-label text-md-right">{{ __('País') }}</label>

                            <div class="col-12 col-sm-9">
                                <select id="pais" class="form-control @error('pais') is-invalid @enderror" name="pais" required>
                                    @foreach ($paises as $pais)
                                    <option value="{{$pais}}" {{$pais == old("pais") ? "selected" : ""}}>
                                        {{$pais}}
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
                            <label for="email" class="col-12 col-sm-3 col-form-label text-md-right">{{ __('E-Mail') }}</label>

                            <div class="col-12 col-sm-9">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-12 col-sm-3 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-12 col-sm-9">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-12 col-sm-3 col-form-label text-md-right">{{ __('Confirmar Password') }}</label>

                            <div class="col-12 col-sm-9">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row">
                                <div class="col-12 col-sm-9 offset-sm-3">
                                    <div class="form-check">
                                        <input class="form-check-input @error('acepto') is-invalid @enderror" type="checkbox" name="acepto" id="acepto" {{ old('acepto') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="acepto">
                                            {{ __('Acepto términos y condiciones') }}
                                        </label>

                                        @error('acepto')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                    </div>
                                </div>
                            </div>

                        <div class="form-group row mb-0">
                            <div class="col-12 col-sm-9 offset-sm-3">
                                <button type="submit" class="btn btn-block btn-warning">
                                    {{ __('Registrarme') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
