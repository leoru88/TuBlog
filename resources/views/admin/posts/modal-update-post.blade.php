<div class="modal fade" id="modal-update-post-{{$post->id}}">
    <div class="modal-dialog">
        <div class="modal-content bg-default">
            <div class="modal-header bg-dark text-white">
                <h4 class="modal-title">Actualizar Post</h4>
                <button type="button" style="color:azure;" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
            </div>

            <form action="{{ route('admin.posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
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
                        <label for="title">Post</label>
                        <input type="text" name="title" class="form-control" id="post" value="{{$post->title}}" required maxlength="100">
                    </div>

                    <div class="form-group">
                        <label for="category-id">Categoría</label>
                        <select name="category_id" id="category-id" class="form=control" required>
                            <option value="">--Elegir categoría--</option>
                            @foreach ($categories as $category)
                            <option value="{{$category->id}}" <?= $category->id == $post->category->id ? 'selected' : '' ?>> {{$category->name}} </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="content">Contenido</label>
                        <textarea name="content" id="content" class="form-control" cols="30" rows="10" required> {{$post->content}} </textarea>
                    </div>

                    <div class="form-group">
                        <label for="author">Autor</label>
                        <input type="text" name="author" class="form-control" id="author" value="{{$post->author}}" required maxlength="100">
                    </div>

                    <div class="form-group">
                        <label for="featured">Imagen principal</label>
                        <input type="file" name="featured" class="form-control" id="featured">
                        <small>Imagen actual</small><br>
                        <img src="{{asset($post->featured)}}" class="img-fluid img-thumbnail" width="100px" alt="{{$post->featured}}">
                    </div>

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
    $(document).ready(function() {
        $('#modal-update-post-{{$post->id}}').on('show.bs.modal', function(event) {
            var modal = $(this);
            var postTitle = '{{$post->title}}';
            var postCategory = '{{$post->category_id}}';
            var postContent = "{!! isset($post->content) ? addslashes(json_encode($post->content, JSON_UNESCAPED_UNICODE)) : 'null' !!}";
            var postAuthor = '{{$post->author}}';

            modal.find('.modal-body #post').val(postTitle);
            modal.find('.modal-body #category-id').val(postCategory);
            modal.find('.modal-body #content').val(JSON.parse(postContent));
            modal.find('.modal-body #author').val(postAuthor);
        });
    });
</script>