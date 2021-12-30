@extends('back.mainLayout')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4"> {{ Route::is('back.product.create') ? 'Crear' : 'Editar' }} producto</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('login') }}">Panel</a></li>
        <li class="breadcrumb-item"><a href="{{ route('back.product.index') }}">Productos</a></li>
        <li class="breadcrumb-item active">Crear</li>
    </ol>
    @isset ($actionOnProduct)
    <div class="alert alert-success" role="alert">
        {{ $actionOnProduct }}
    </div>
    @endif
    <form action="{{ Route::is('back.product.create') ? route('back.product.store') : route('back.product.update') }}" 
          method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" value="{{ $product->id ?? '' }}">
        <div class="mb-3">
            <label for="name" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="name" name="name"
                value="{{ $product->name ?? '' }}">
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Descripción</label>
            <textarea name="description" id="description" class="form-control">{{$product->description ?? ''}}
            </textarea>
        </div>
        <br>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>
@endsection