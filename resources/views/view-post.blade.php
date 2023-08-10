@extends('layouts.app')
@section('content')
<div class="text-center">
  <input type="text" class="text-center" id="search_video" onkeyup="search_video()" style="width:400px;" placeholder="Search Video.." name="search">

</div>
<div class="videopostlist" style="text-align: center;">
    
    @foreach ($user_video as $video_data)
    <div class="video-post">
      <video width="320" poster="{{url('uploads/image/'.$video_data->image)}}" height="240" controls >
        <source src="{{url('uploads/video/'.$video_data->video)}}" type="video/mp4">
        Your browser does not support the video tag.
      </video>
      <h3 class="video-title">{{$video_data->title}}</h3>
      <h4>User : {{$video_data->username}}</h4>
      <p>Posted on: {{$video_data->created_at->diffForHumans()}}</p>
    
      
      @php
          $comments = App\Models\Comment::where('comments.video_id',$video_data->id)->join('users','users.id','=','comments.user_id')->select('comments.*','users.username')->get();
      @endphp
      <div class="comments ">
        @foreach( $comments as $comment)
        <hr>
        <div class="comment">
          <p>Comment - {{$loop->iteration}}</p>
          <p class="author">UserName:{{$comment->username}}</p>
          <p>{{$comment->comment}}</p>
          <p class="timestamp">Posted on:{{$comment->created_at}}</p>
        </div>
        <hr>
        @endforeach
      </div>
    </div>
    @endforeach
    <p class="text-danger" id="noresult" style="display:none">No Video Post Found</p>
  </div>

  <script>
    function search_video() {

    var input, filter, i, txtValue,videopost,videotitle,count;
    input = document.getElementById("search_video");
    filter = input.value.toUpperCase();
    videopost=document.querySelectorAll(".video-post")
      count=0;
    for(i=0; i<videopost.length; i++){
      videotitle=videopost[i].querySelector(".video-title")
      txtValue = videotitle.textContent || videotitle.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
          videopost[i].style.display = "";
          count++;
        } else {
          videopost[i].style.display = "none";
        }

    }

    if(count > 0){
      document.querySelector("#noresult").style.display="none"

    }
    else{
      document.querySelector("#noresult").style.display="block"
    }

    }
  </script>
@endsection