@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Subir Video</div>

                <div class="card-body">
                    <form action="{{route('videos.store')}}" method="post" enctype="multipart/form-data">
                      @csrf
                      <div class="form-group">
                        <label for="name">Nombre video</label>
                        <input type="text" class="form-control" id="name" name="name" aria-describedby="nameHelp">
                        <small id="nameHelp" class="form-text text-muted">pon un nombre llamativo</small>
                      </div>
                      <div class="form-group">
                        <label for="duration">Duración</label>
                        <input type="time" format="HH:MM:SS" name="duration" class="form-control" id="duration">
                      </div>
                      <div class="form-group">
                        <label for="description">Descripción</label>
                        <textarea class="form-control" id="description" name="description"></textarea>
                      </div>
                      <div class="form-group">
                        <label for="category">Categoría</label>
                        <select class="form-control" id="category" name="category">
                            <option value="">-- categoria --</option>
                            <option value="Desarrollo Móvil">Desarrollo Móvil</option>
                            <option value="Desarrollo Web">Desarrollo Web</option>
                            <option value="Desarrollo de Escritorio">Desarrollo de Escritorio</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="status">Estado</label>
                        <select class="form-control" id="status" name="status">
                            <option value="">-- estado --</option>
                            <option value="0">Por Revisar</option>
                            <option value="1">Publicado</option>
                            <option value="2">Privado</option>
                        </select>
                      </div>
                      <div class="form-row">
                        <div class="col-6">
                          <div class="form-group">
                            <label for="image">Imagen</label>
                            <input type="file" class="form-control file-input" name="image" id="image" accept=".jpg,jpeg,.png">
                          </div>
                        </div>
                        <div class="col-6">
                          <div class="form-group">
                            <label for="video">Video</label>
                            <input type="file" class="form-control file-input" id="video" name="video" accept=".mp4,.mpg4">
                          </div>
                        </div>
                      </div>
                      <button type="submit" class="btn btn-primary">Enviar</button>
                      <button type="submit" class="btn btn-secundary">Cancelar</button>
                    </form>
                </div>
                <div class="card-footer">
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
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script type="text/javascript">
    $(document).ready(function() {
        $(".file-input").fileinput({'showUpload':false, 'previewFileType':'any', 'theme':'fa'});
    })
</script>
@endsection