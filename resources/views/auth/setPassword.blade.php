@extends('auth.layout')
@section('title', 'Escribe tu nueva contraseña')
@section('content')
    {{ $token }}
    <div class="container">

        <form method="POST" action="{{route('setPassword')}}">
            @csrf
            <input type="text" name="token" class="d-none" value={{$token}} id="password">
            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" name="password" class="form-control" id="password">
            </div>
            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Verifica tu contraseña</label>
                <input type="password" name="password_confirmation" class="form-control" id="password_confirmation">
            </div>
            <button type="submit" class="btn btn-primary">Enviar</button>
        </form>
    </div>
@endsection
