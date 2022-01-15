@extends('back.mainLayout')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Crear token</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('login') }}">Panel</a></li>
        <li class="breadcrumb-item active">Crear Token</li>
    </ol>

    @isset ($tokenResponse)
        <div class="card mb-4 alert alert-success" role="alert">
            <div class="card-body">
                {{ $tokenResponse }}
            @isset($token)
                <br>Valor: {{ $token['value'] }}
                <br>Tipo: {{ $token['type'] }}
                <br>Duración: {{ $token['duration'] }} minutos.
            @endisset
            </div>
        </div>
    @endif

    <div class="card mb-4">
        <div class="card-body">
            <p>Para generar un nuevo token e invalidar el anterior,
                debes volver entrar tu correo i tu contraseña</p>
        </div>
    </div>

    <form action="{{ route('back.user.generateApiToken') }}" method="POST">
        @csrf
        <div class="mb-3 row">
            <div class="col-sm-6">
                <label for="email" class="form-label">Correo</label>
                <input type="email" name="email" class="form-control">
            </div>
            <div class="col-sm-6">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" class="form-control" name="password">
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Enviar</button>
    </form>

</div>
@endsection