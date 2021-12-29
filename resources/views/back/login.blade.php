<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('css/back-template.css') }}">
    <style>
        body {
            background: #007bff;
            background: linear-gradient(to right, #0062E6, #33AEFF);
        }
    
        .btn-login {
            font-size: 0.9rem;
            letter-spacing: 0.05rem;
            padding: 0.75rem 1rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
        <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
            <div class="card border-0 shadow rounded-3 my-5">
            <div class="card-body p-4 p-sm-5">
                <h3 class="text-center font-weight-light my-4">Iniciar sesión</h3>
                <form action="{{ route('handleLogin') }}" method="POST">
                    @csrf
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="email" name="email" placeholder="nombre@correo.com" required>
                        <label for="email">Correo electrónico</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña" required>
                        <label for="password">Contraseña</label>
                    </div>

                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" value="true" name="rememberMe" id="rememberMe">
                        <label class="form-check-label" for="rememberMe">
                        Recuérdame
                        </label>
                    </div>
                    <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                        <a class="small" href="password.html">Olvidaste tu contraseña?</a>
                        <button class="btn btn-primary btn-login text-uppercase fw-bold" type="submit">Iniciar sesión</button>
                    </div>
                    <div class="mt-3">
                        @if (!empty($errors->all()))
                            <div class="alert alert-danger" role="alert">
                                @foreach ($errors->all() as $error)
                                    {{ $error }}<br>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </form>
            </div>
            </div>
        </div>
        </div>
    </div>
</body>
</html>