@extends('back.mainLayout')

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4"> {{ Route::is('back.childCategory.create') ? 'Crear' : 'Editar' }} categoría hija</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('login') }}">Panel</a></li>
        <li class="breadcrumb-item"><a href="{{ route('back.childCategory.index') }}">Categorías hijas</a></li>
        <li class="breadcrumb-item active">Crear</li>
    </ol>
    @isset ($actionOnCategory)
    <div class="alert alert-success" role="alert">
        {{ $actionOnCategory }}
    </div>
    @endif
    <form action="{{ Route::is('back.childCategory.create') ? route('back.childCategory.store') : route('back.childCategory.update') }}" 
          method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" value="{{ $category->id ?? '' }}">
        <div class="mb-3">
            <label for="name" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="name" name="name"
                value="{{ $category->name ?? '' }}">
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Descripción</label>
            <textarea name="description" id="description" class="form-control">{{ $category->description ?? '' }}
            </textarea>
        </div>
        <div class="mb-3">
            <label for="categories" class="form-label">Categorías</label>
            <select name="categories" id="categories" class="form-control">
                @if (isset($product) && $product->categories->count() > 0)
                    @foreach ($product->categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                @endif  
            </select>
        </div>
        <br>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>
@endsection

@section('js')
<script
  src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
   document.addEventListener('DOMContentLoaded', function() {
    $('#categories').select2({
        ajax: {
            url: "{{ route('back.childCategory.filter') }}",
            dataType: "JSON",
            type: "GET",
            processResults: function (data) {
                return {
                    results: data.results
                };
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log("Status: " + xhr.status);
                console.log("Error: " + thrownError);
            }
        },
        placeholder: 'Selecciona categorías para el producto',
        allowClear: true,
        multiple: true
    });
    
   });
</script>
@endsection