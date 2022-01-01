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
            Aquí se muestran todas las categorías padre.
        </div>
    </div>

    @if (session()->has('actionOnCategory'))
    <div class="alert alert-danger" role="alert">
        {{ session()->get('actionOnCategory') }}
    </div>
    @endif

    @include('back.parentCategory.modal')

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
                            <a href='{{ route('back.parentCategory.edit', $category->id) }}' id="{{$category->id}}" class='btn btn-primary m-r-lem'>
                                <i class="fas fa-edit"></i> Editar
                            </a> 
                            <a href='{{ route('back.parentCategory.destroy', $category->id) }}' id="{{$category->id}}" class='btn btn-danger delete-category'>
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

@section('js')
<script
  src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  crossorigin="anonymous">
</script>
{{-- Triggers bootstrap modal when deleting a parent category which has children --}}
<script>
const modalDelete = new bootstrap.Modal(document.getElementById('modalDelete'));
let formDelete = document.getElementById('formDelete');

$(document).on('click', '.delete-category', function(e) {
    e.preventDefault();
    console.log(e.target.id);
    modalDelete.toggle();
    $('#hideModal').click(function() {
        modalDelete.hide();
    })
    $('#confirmDeletion').attr('href', "{{ route('back.parentCategory.confirmDestruction') }}" + '/' + e.target.id);
    $('#deleteRecursively').attr('href', "{{ route('back.parentCategory.destroyWithChildren') }}" + '/' + e.target.id);
});
</script>
@endsection
