@extends('auth.layout')
@section('title', 'Recuperación de contraseña')
@section('content')
    <h3>Recupera tu contraseña</h3>
    <h4>Cambio de contraseña</h4>
    <p>Hemos recibido un pedido de cambio de contraseña de tu cuenta. Si has sido tú, puedes dar click en el siguiente
        botón.</p>
    <a href="{{ $url }}"> Recuperar contraseña</a>
    <p>Si no quieres ingresar una nueva contraseña o no has sido tu quien lo ha solicitado, simplemente ignora este mensaje.
    </p>

    <h4>¿Tienes alguna duda?</h4>
    <p>No dudes en visitar nuestro centro de ayuda o contactarnos por whatsapp, con gusto resolveremos tus preguntas.</p>
    {{ $token }}

@endsection
