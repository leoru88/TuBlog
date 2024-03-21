@extends('adminlte::page')

@section('title', 'Admin - Categorías')

@section('content_header')

<div class="d-flex justify-content-center">
    <button type="button" class="btn col-2 bg-dark text-white" data-toggle="modal" data-target="#modal-create-category">
        CREAR CATEGORÍA
    </button>
</div>

@stop

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-dark">
                    <h3 class="card-title text-white">Listado de categorías</h3>
                </div>
                <div class="card-body">
                    <table id="categories" class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Categoría</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                            <tr>
                                <td>{{$category->id}}</td>
                                <td>{{$category->name}}</td>

                                <td>
                                    <div class="btn-group">
                                        <button type="button" style="margin-right: 5px;" class="btn btn-warning" data-toggle="modal" data-target="#modal-update-category-{{$category->id}}">
                                            Editar
                                        </button>
                                        <form action="{{ route('admin.categories.delete', $category->id) }}" method='POST'>
                                            {{ csrf_field() }}
                                            @method('DELETE')
                                            <button class="btn btn-danger">Eliminar</button>
                                        </form>
                                    </div>
                                </td>

                            </tr>
                            @include('admin.categories.modal-update-category')
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-create-category">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h4 class="modal-title text-white">Crear Categoría</h4>
                <button type="button" style="color:azure;" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
            </div>


            <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="form-group">

                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                    </div>
                    <label for="name">Nombre de la Categoría</label>
                    <input type="text" name="name" class="form-control" id="category" required maxlength="50">
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-outline-light" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-outline-dark">Crear</button>
                </div>
            </form>
        </div>
    </div>
</div>
@stop
@section('js')

<style>
    .pagination>.active>span,
    .pagination>.active>span:hover,
    .pagination>.active>a,
    .pagination>.active>a:hover,
    .pagination>.active>span:focus,
    .pagination>.active>a:focus {
        background-color: #343a40;
        border-color: #000000;
        color: #ffffff;
    }

    .pagination>.page-item>.page-link {
        color: #343a40;
        background-color: #e9ecef;
        border-color: #000000;
    }

    .pagination>.page-item>.page-link:hover {
        background-color: #343a40;
        border-color: #343a40;
        color: #ffffff;
    }
</style>

</div>

<script>
    $(document).ready(function() {
        $('#categories').DataTable({
            "paging": true,
            "pagingType": "full_numbers",
            "language": {
                "paginate": {
                    "previous": "Anterior",
                    "next": "Siguiente",
                    "last": "Último",
                    "first": "Primero"
                },
                "info": "Mostrando _START_ a _END_ de _TOTAL_ entradas"
            }
        });
    });
</script>

@stop