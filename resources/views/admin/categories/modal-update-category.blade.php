<div class="modal fade" id="modal-update-category-{{$category->id}}">
    <div class="modal-dialog">
        <div class="modal-content bg-default">
            <div class="modal-header bg-dark text-white">
                <h4 class="modal-title">Editar Categoría</h4>
                <button type="button" style="color:azure;" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
            </div>

            <form action="{{ route('admin.categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
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
                    <label for="name">Categoría</label>
                    <input type="text" name="name" class="form-control" id="category" value="{{$category->name}}" required maxlength="50">
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-outline-light" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-outline-primary">Actualizar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
    $(document).ready(function(){
        $('#modal-update-category-{{$category->id}}').on('show.bs.modal', function (event) {
            var modal = $(this);
            var categoryName = '{{$category->name}}';
            modal.find('.modal-body #category').val(categoryName);
        });
    });
</script>
