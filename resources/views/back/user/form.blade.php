@extends('back.mainLayout')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4"> {{ Route::is('back.user.create') ? 'Crear' : 'Editar' }} usuario</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('login') }}">Panel</a></li>
        <li class="breadcrumb-item"><a href="{{ route('back.user.index') }}">Usuarios</a></li>
        <li class="breadcrumb-item active">Crear</li>
    </ol>
    @isset ($actionOnUser)
    <div class="alert alert-success" role="alert">
        {{ $actionOnUser }}
    </div>
    @endif
    <form action="{{ Route::is('back.user.create') ? route('back.user.store') : route('back.user.update') }}" 
          method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" value="{{ $user->id ?? '' }}">
        <div class="mb-3">
            <label for="name" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="name" name="name"
                value="{{ $user->name ?? '' }}">
        </div>
        <div class="mb-3">
            <label for="surname" class="form-label">Apellido</label>
            <input type="text" class="form-control" id="surname" name="surname"
                value="{{ $user->surname ?? '' }}">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Correo</label>
            <input type="email" class="form-control" id="name" name="email"
                value="{{ $user->email ?? '' }}">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Contraseña</label>
            <input type="password" class="form-control" id="password" name="password"
                value="">
        </div>
        <div class="mb-3">
            <label for="photo" class="form-label">Foto</label>
            <input type="file" class="form-control" id="photo" name="photo"
                value="{{ $user->photo ?? '' }}">
        </div>
        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" role="switch" id="is_admin"
                   name="is_admin" {{ isset($user) && $user->is_admin == true ? 'checked' : ''}}>
            <label class="form-check-label" for="is_admin">Es admin</label>
        </div>
        <br>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>
@endsection