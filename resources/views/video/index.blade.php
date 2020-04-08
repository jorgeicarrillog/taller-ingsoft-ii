@extends('layouts.app')

@section('content')
<div class="container">
    @if (session('status'))
        <div aria-live="polite" aria-atomic="true" style="position: absolute;min-height: 200px;min-width: 300px;right: 5px;">
            <div class="toast" style="position: absolute; top: 0; right: 0;opacity: 1;" role="alert" aria-live="polite" aria-atomic="true" data-delay="10000" id="status-message">
              <div class="toast-header">
                <strong class="mr-auto">{{config('app.name')}}</strong>
                <small class="text-muted">Hace un momento</small>
                <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="toast-body">
                {{ session('status') }}
              </div>
            </div>
        </div>
    @endif
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h1>Videos
                    <a href="{{route('videos.create')}}" class="d-inline-flex float-right btn btn-primary">Subir video</a>
                </h1></div>

                <div class="card-body">

                    <div class="card-columns">
                        @foreach($videos as $video)
                        <div class="card">
                            <div class="videos" data-src="{{Storage::url($video->video)}}">
                              <div class="video-wrap">
                                <div class="play-btn"></div>
                                <img class="placeholder" src="{{Storage::url($video->image)}}" alt="{{$video->name}}" />
                              </div>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">
                                    @if($video->status==0)
                                    <i class="fas fa-clock text-warning"></i>
                                    @elseif($video->status==1)
                                    <i class="fas fa-globe-americas text-success"></i>
                                    @else
                                    <i class="fas fa-lock text-dark"></i>
                                    @endif
                                    {{$video->name}}
                                </h5>
                                <p class="card-text"><small class="text-muted">Duración: {{$video->duration}}</small><br>
                                    <span class="badge badge-dark">{{$video->category}}</span><br>
                                    {{$video->description}}</p>
                            </div>
                        </div>
                        @endforeach
                  </div>
                    {{ $videos->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
<div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <iframe width="100%" height="360" frameborder="0" allowfullscreen=""></iframe>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
    <script type="text/javascript">
    $(document).ready(function() {
        $('#status-message').toast('show');$('#status-message .close').click(function() {$('#status-message').remove()});
        $('.videos').click(function () {
            var src = $(this).data('src');
            $('#myModal').modal('show');
            $('#myModal iframe').attr('src', src);
        });

        $('#myModal button').click(function () {
            $('#myModal iframe').removeAttr('src');
        });
        $('#myModal').on('hidden.bs.modal', function (e) {
            $('#myModal iframe').removeAttr('src');
        })
    })
</script>
@endsection