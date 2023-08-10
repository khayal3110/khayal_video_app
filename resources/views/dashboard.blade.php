@extends('layouts.app')
@section('content')
    <h5 id="user_title">Hello {{auth()->user()->username}}</h5>
    <h5 id="totalPhotos">number of videos : {{sizeof($videos)}}</h5>
    <div class="photo-grid" id="photoGri">
                @foreach ($videos as $video)
                    <div class="photoitem w-0" style="
                    text-align: center;">
                        <video width="250" poster="{{ url('uploads/image/' . $video->image) }}" height="240" controls
                            style="margin-left: 15px;">
                            <source src="{{ url('uploads/video/' . $video->video) }}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                        <h3>{{ $video->title }}</h3>
                        @if (Auth::check())
                            <button type="button" id="cmt" data-id="{{ $video->id }}"
                                style="margin-left:19px; width:100px">Comment</button>
                        @else
                            <a type="button" href="{{ route('login') }}"style="margin-left:19px; width:100px">Comment</a>
                        @endif
                    </div>
                @endforeach
    </div>
    <section>
        {{-- <h2>Welcome to Video Upload Web App</h2>
    <p>This web application allows you to upload and share your videos with others.</p>
    <p>Get started by uploading your videos using the "Upload Video" link in the navigation bar above.</p> --}}
    </section>

    <div class="modal fade" id="comment-model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm " role="document">
            <div class="modal-content">
                <div class="modal-header library-modal-header">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Comment</h5>
                    <button type="button" class="btn-close me-1" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="commentform" method="post">
                        <input type="hidden" id="video_id" name="video_id" value="0">
                        <div class="form-group mb-2">
                            <label class="control-label">Comment</label>
                            <input type="text" class="form-control" name="comment" id="comment">
                        </div>
                        <div class="form-group mb-2">
                            <button type="submit" class="fw-bold" style="margin-left:19px; width:100px">Comment</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        $(document).on('click', '#cmt', function() {
            var video_id = $(this).data('id');
            $('#video_id').val(video_id);
            $('#comment-model').modal('show');
        });

        $(".btn-close").click(function(){
          $('#comment-model').modal('hide');

        })
    </script>
@endpush
