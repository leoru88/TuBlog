@extends('adminlte::page')

@section('title', 'Admin - Posts')

@section('content_header')

<div class="d-flex justify-content-center">
    <button type="button" class="btn col-2 bg-dark text-white" data-toggle="modal" data-target="#modal-create-post">
        CREAR POST
    </button>
</div>

@stop

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-dark">
                    <h3 class="card-title text-white">Listado de posts</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="posts" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Categoría</th>
                                    <th>Post</th>
                                    <th>Imagen</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($posts as $post)
                                <tr>
                                    <td>{{$post->id}}</td>
                                    <td>{{$post->category->name}}</td>
                                    <td>{{$post->title}}</td>
                                    <td>
                                        <img src="{{asset($post->featured)}}" alt="{{$post->title}}" class="img-fluid img-thumbnail" width="100px">
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" style="margin-right: 5px;" class="btn btn-warning" data-toggle="modal" data-target="#modal-update-post-{{$post->id}}">
                                                Editar
                                            </button>
                                            <form action="{{ route('admin.posts.delete', $post->id) }}" method='POST'>
                                                {{ csrf_field() }}
                                                @method('DELETE')
                                                <button class="btn btn-danger">Eliminar</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @include('admin.posts.modal-update-post')
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-create-post">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h4 class="modal-title">Crear Post</h4>
                <button type="button" style="color:azure;" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/admin/posts.store" method="POST" enctype="multipart/form-data">
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
                       
                        <label for="title">Título</label>
                        <input type="text" name="title" class="form-control" id="title" required maxlength="100">

                    </div>
                    <div class="form-group">
                        <label for="category-id">Categoría</label>
                        <select name="category_id" id="category-id" class="form-control" required>
                            <option value="">--Elegir categoría--</option>
                            @foreach ($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="content">Contenido</label>
                        <textarea name="content" id="content" class="form-control" cols="30" rows="10" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="author">Autor</label>
                        <input type="text" name="author" class="form-control" id="author" required maxlength="100">
                    </div>
                    <div class="form-group">
                        <label for="featured">Imagen</label>
                        <input type="file" name="featured" class="form-control" id="featured" required>
                    </div>
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
        $('#posts').DataTable({
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