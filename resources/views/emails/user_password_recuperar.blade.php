@extends('emails.master')
@section('content')
<p>Hola:<strong> {{ $name }}</strong></p>
<p>Este es un correo electrónico que te ayudara a reestablecer la contraseña de su cuenta en nuestra plataforma.</p>
<p>Para continuar haga clic en el siguiente botón e ingrese el siguiente código:<h2><strong>{{ $code }}</strong></h2></p>
<p><a href="{{ url('/reset?email='.$email) }}" style="display: inline-block; background-color: #26ab62; color:#fff;
     padding: 12px; border-radius:4px; text-decoration: none;">Recuperar contraseña</a></p>
<p>En caso de No funsionar el botón copie y pegue la siguiente url en el navegador:</p>
<p>{{ url('/reset?email='.$email) }}</p>

@stop
