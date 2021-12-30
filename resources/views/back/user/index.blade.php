@extends('back.mainLayout')

@section('css')
    <style>
        .user-photo {
            border-radius: 100%;
            height: 70px; 
            width: 80px;
        }
    </style>
@endsection

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Usuarios</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('login') }}">Panel</a></li>
        <li class="breadcrumb-item active">Usuarios</li>
        <li class="breadcrumb-item active">Índice</li>
    </ol>
    <div class="card mb-4">
        <div class="card-body">
            Aquí se muestran todos los usuarios registrados.
        </div>
    </div>
    @if (session()->has('actionOnUser'))
    <div class="alert alert-danger" role="alert">
        {{ session()->get('actionOnUser') }}
    </div>
    @endif
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Listado de usuarios de la plataforma
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>Foto</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Correo</th>
                        <th>Es admin</th>
                        <th>Fecha de alta</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody class="table-hover">
                    @foreach ($users as $user)
                    <tr>
                        <td><img src="{{ asset('storage/userPhotos') . '/' . $user->photo }}" class="user-photo" alt="Foto del usuario."></td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->surname }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->is_admin ? 'Sí' : 'No' }}</td>
                        <td>{{ $user->created_at }}</td>
                        <td>
                            <a href='{{ route('back.user.edit', $user->id) }}' class='btn btn-primary m-r-lem'>
                                <i class="fas fa-edit"></i> Editar
                            </a> 
                            <a href='{{ route('back.user.destroy', $user->id) }}' class='btn btn-danger'>
                                <i class="fas fa-trash-alt"></i> Eliminar
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $users->links() }}
        </div>
    </div>
</div>
@endsection