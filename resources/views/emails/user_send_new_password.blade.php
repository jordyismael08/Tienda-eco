@extends('emails.master')
@section('content')
<p>Hola:<strong> {{ $name }}</strong></p>
<p>Esta es la nueva contraseña para tu cuenta en nuestra plataforma.</p>
<p><h2><strong>{{ $password }}</strong></h2></p>
<p>Para iniciar haga clic en el siguiente botón</p>
<p><a href="{{ url('/login') }}" style="display: inline-block; background-color: #26ab62; color:#fff;
     padding: 12px; border-radius:4px; text-decoration: none;">Recuperar contraseña</a></p>
<p>En caso de No funsionar el botón copie y pegue la siguiente url en el navegador:</p>
<p>{{ url('/login') }}</p>

@stop
