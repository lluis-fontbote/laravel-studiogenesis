@extends('back.mainLayout')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Productos</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('login') }}">Panel</a></li>
        <li class="breadcrumb-item active">Productos</li>
        <li class="breadcrumb-item active">Índice</li>
    </ol>
    <div class="card mb-4">
        <div class="card-body">
            Aquí se muestran todos las productos.
        </div>
    </div>
    @if (session()->has('actionOnProduct'))
    <div class="alert alert-danger" role="alert">
        {{ session()->get('actionOnProduct') }}
    </div>
    @endif
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Listado de productos de la plataforma
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                    </tr>
                </thead>
                <tbody class="table-hover">
                    @foreach ($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ Str::limit($product->description, 70) }}</td>
                        <td>
                            <a href='{{ route('back.product.edit', $product->id) }}' class='btn btn-primary m-r-lem'>
                                <i class="fas fa-edit"></i> Editar
                            </a> 
                            <a href='{{ route('back.product.destroy', $product->id) }}' class='btn btn-danger'>
                                <i class="fas fa-trash-alt"></i> Eliminar
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $products->links() }}
        </div>
    </div>
</div>
@endsection