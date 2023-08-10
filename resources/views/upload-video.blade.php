@extends('layouts.app')
@section('content')
<section>
    <h1>Video Upload Form</h1>
    <form id="uploadVideo" method="post" enctype="multipart/form-data" onsubmit="return false;">
    <li>
      <label for="title">Title:</label>
      <input type="text" id="title" name="title" required>
    </li>

    <li>
      <label for="description">Description:</label>
      <input type="text" id="description" name="description" required>
    </li>
<hr/>
    <li>
      <label for="thumbnail">Thumbnail:</label>
      <input type="file" id="image" name="image" accept="image/*" required>
    </li>
<hr/>

    <li>
      <label for="video">Video:</label>
      <input type="file" id="video" name="video" accept="video/*" required>
    </li>
    <hr/>

    <li>
      <label for="acceptPolicy">
        <input type="checkbox" style="width:34px; height:18px;" id="acceptPolicy" name="acceptPolicy" required>
        I accept the Acceptable Use Policy for uploading videos.
      </label>
    </li>
    <hr/>

    <li>
      <button type="submit">upload</button>
    </li>
    </form>
  </section>
@endsection
@push('script')
  <script>
        $('body').on('submit', '#uploadVideo', function(){
            var formData = new FormData(this);
            var ajaxurl = base_url+'/save-video';
            $('.ajax-loader').show();
            var request = $.ajax({
                url: ajaxurl,
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                },
                data: formData,
                processData: false,
                contentType: false,
                dataType: "json"
            });
            request.done(function(response) {
               $('.ajax-loader').hide();
               if (response.sts == false){
                swal("" + response.msg, {
                icon: "error",
                });
                }else{
                    swal("" + response.msg,{
                    icon: "success",
                    });
                    setTimeout(function() {
                      window.location.href = base_url+'/view-post';


                    }, 3000);


                }
              });
            request.fail(function(jqXHR, textStatus) {
                $('.ajax-loader').hide();
                var error = JSON.parse(jqXHR.responseText);
                swal("", 'Request failed: '+ error.message, {
                    icon: "error",
                });
            }); 
        return false;
          });
  </script>
@endpush