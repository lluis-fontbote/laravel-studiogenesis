@extends('back.mainLayout')

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4"> {{ Route::is('back.product.create') ? 'Crear' : 'Editar' }} producto</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('login') }}">Panel</a></li>
        <li class="breadcrumb-item"><a href="{{ route('back.product.index') }}">Productos</a></li>
        <li class="breadcrumb-item active">{{ Route::is('back.product.create') ? 'Crear' : 'Editar' }}</li>
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
            <textarea name="description" id="description" class="form-control">{{$product->description ?? ''}}</textarea>
        </div>
        <div class="mb-3">
            <label for="categories" class="form-label">Categorías</label>
            <select name="categories[]" id="categories" class="form-control">
                @if (isset($product) && $product->categories->count() > 0)
                    @foreach ($product->categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                @endif  
            </select>
        </div>
        <div class="mb-3" id="pricesContainer">
            <div class="row">
                <div class="col">
                    <label for="">Precios</label>
                    <br>
                    <button id="addPrice" class="btn btn-dark" type="button">
                        Añadir
                    </button>
                </div>
            </div>
            @isset($product->prices)
                @foreach ($product->prices as $price)
                <div class="row row-cols-lg-auto g-3 align-items-center mt-1 prices">
                    <div class="form-group col">
                    <label for="amount[]">Cantidad</label>
                    <input type="number" class="form-control" id="amount[]" name="amount[]" 
                            min="0.00" max="10000.00" step="0.01" value="{{ $price->amount }}"/>
                    </div>
                    <div class="form-group col">
                    <label for="startDate[]">Inicio</label>
                    <input type="date" class="form-control" name="startDate[]" id="startDate" 
                           value="{{ date('Y-m-d', strtotime($price->start_date)) }}">
                    </div>
                    <div class="form-group col">
                        <label for="endDate[]">Final</label>
                        <input type="date" class="form-control" name="endDate[]" id="endDate[]" 
                               value="{{ date('Y-m-d', strtotime($price->end_date)) }}">
                    </div>
                    <div class="form-group col" style="align-self: end;">
                        <button class="btn btn-danger deletePrice" type="button">Elimina</button>
                    </div>
                </div>
                @endforeach
            @endisset
        </div>
        <div id="photosContainer">
            <div class="row">
                <div class="col">
                    <label for="">Imágenes</label>
                </div>
            </div>
            @isset($product->photos)
                @foreach ($product->photos as $photo)
                    <div class="row photos mt-1">
                        <div class="form-group col">
                            <img src="{{ asset('storage/productPhotos') . '/' . $photo->filename }}" class="img-thumbnail" alt="...">
                        </div> 
                        <div class="form-group col">
                            <label for="delete_product_photo[{{$photo->id}}]">Eliminar</label>
                            <input type="checkbox" name="delete_product_photo[{{$photo->id}}]" id="delete_product_photo[{{$photo->id}}]">    
                        </div>
                    </div>
                @endforeach
            @endisset
            <button id="addPhoto" class="btn btn-dark mt-1" type="button">
                Añadir
            </button>
        </div>
        <br>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>
@endsection

@section('js')
{{-- Jquery and select2, necessary for category select to work --}}
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
    
    $('#categories').val([
        {{ isset($product) ? $product->getAllCategoriesIDs() : ''}}
    ]).change();
   });
</script>

{{-- Adds and deletes price rows --}}
<script>
    $('#addPrice').click(function() {
        $('#pricesContainer').append(
            `<div class="row row-cols-lg-auto g-3 align-items-center mt-1 prices">
                <div class="form-group col">
                <label for="amount[]">Cantidad</label>
                <input type="number" class="form-control" id="amount[]" name="amount[]" 
                        min="0.00" max="10000.00" step="0.01"/>
                </div>
                <div class="form-group col">
                <label for="startDate[]">Inicio</label>
                <input type="date" class="form-control" name="startDate[]" id="startDate">
                </div>
                <div class="form-group col">
                    <label for="endDate[]">Final</label>
                    <input type="date" class="form-control" name="endDate[]" id="endDate[]">
                </div>
                <div class="form-group col" style="align-self: end;">
                    <button class="btn btn-danger deletePrice" type="button">Elimina</button>
                </div>
            </div>`
        );
    });
    $(document).on('click','.deletePrice', function() {
        $(this).closest('.prices').remove();
    })

    $('#addPhoto').click(function() {
        $('#photosContainer').append(
            `<div class="row photos mt-1">
                <div class="col">
                    <input type="file" name="photos[]" id="photos[]" class="form-control">
                </div>
                <div class="col">
                    <button class="btn btn-danger deletePhoto" type="button">Elimina</button>                            
                </div>
            </div>`
        );
    });
    $(document).on('click','.deletePhoto', function() {
        $(this).closest('.photos').remove();
    })
</script>
@endsection