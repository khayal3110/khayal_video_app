@extends('layouts.app')
@section('content')
  <h2>Login Form</h2>
  <form id="loginform" method="post">
    <div class="imgcontainer">
      <img src="{{asset('img2.jpg')}}" alt="Avatar" class="avatar" style="width: 100px"; height="100px">
    </div>
    <div class="container">
      <label for="uname"><b>Username</b></label>
      <input type="email" placeholder="Enter Username" name="email" required>
  
      <label for="psw"><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="password" required>
          
      <button type="submit">Login</button>
      <label>
        <input type="checkbox" checked="checked" name="remember" required> Remember me
      </label>
    </div>
  
    {{-- <div class="container" style="background-color:#f1f1f1">
      <button type="button" class="cancelbtn">Cancel</button>
      <span class="psw">Forgot <a href="#">password?</a></span>
    </div> --}}
  </form>

  <section>
    <h3>About</h3>
    <p>This is the about page content.</p>
  </section>
@endsection
@push('script')
  <script>
        $('body').on('submit', '#loginform', function(){
            var formData = new FormData(this);
            var ajaxurl = base_url+'/login';
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
                    window.location.href = base_url+response.redirect_url;
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