@extends('back.mainLayout')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Categorías padre</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('login') }}">Panel</a></li>
        <li class="breadcrumb-item active">Categorías padre</li>
        <li class="breadcrumb-item active">Índice</li>
    </ol>
    <div class="card mb-4">
        <div class="card-body">
            Aquí se muestran todos las categorías padre.
        </div>
    </div>
    @if (session()->has('actionOnCategory'))
    <div class="alert alert-danger" role="alert">
        {{ session()->get('actionOnCategory') }}
    </div>
    @endif
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Listado de categorías de la plataforma
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody class="table-hover">
                    @foreach ($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->name }}</td>
                        <td>{{ Str::limit($category->description, 70) }}</td>
                        <td>
                            <a href='{{ route('back.childCategory.edit', $category->id) }}' class='btn btn-primary m-r-lem'>
                                <i class="fas fa-edit"></i> Editar
                            </a> 
                            <a href='{{ route('back.childCategory.destroy', $category->id) }}' class='btn btn-danger'>
                                <i class="fas fa-trash-alt"></i> Eliminar
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $categories->links() }}
        </div>
    </div>
</div>
@endsection