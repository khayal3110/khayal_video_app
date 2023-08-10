@extends('layouts.app')
@section('content')
    <h5 id="totalPhotos">Number of Videos : {{sizeof($videos)}}</h5>
    {{-- <div class="container"> --}}
      <div class="photo-grid" id="photoGrid">
        {{-- <div class="col-12"> --}}
            {{-- <div class="d-flex" style="display:flex; flex-wrap: wrap;"> --}}
                {{-- <div class="d-flex" style="display:flex; flex-wrap: wrap;"> --}}
                @foreach ($videos as $video)
                    <div class="photoitem w-0" style="
                    text-align: center;">
                        {{-- <div class="photoitem w-0" style="flex: 25%;"> --}}
                        <video width="250" poster="{{ url('uploads/image/' . $video->image) }}" height="240" controls>
                            <source src="{{ url('uploads/video/' . $video->video) }}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                        <h3>{{ $video->title }}</h3>
                        @if (Auth::check())
                            <button type="button" data-id="{{ $video->id }}"
                                style="margin-left:19px; width:100px">Comment</button>
                        @else
                            <button type="button" onclick="window.location.href='{{ route('login') }}'"
                                style="margin-left:19px; width:100px"> Comment</button>
                        @endif
                    </div>
                @endforeach
            {{-- </div> --}}
        {{-- </div> --}}
    </div>
    {{-- </div> --}}
    
    <section>
        <h2>Welcome to Video Upload Web App</h2>
        <p>This web application allows you to upload and share your videos with others.</p>
        <p>Get started by uploading your videos using the "Upload Video" link in the navigation bar above.</p>
    </section>
@endsection
@push('script')
    <script>
        $(document).on('click', '.cmt', function() {
            var order_id = $(this).data('id');
            $('#video_id').val(video_id);
            $('#comment-model').modal('show');
        });


        $(".btn-close").click(function(){
          $('#comment-model').modal('hide');

        })
    </script>
@endpush
