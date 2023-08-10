<!doctype html>
<html>
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--favicon-->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

	<link href="{{asset('assets/css/app.css')}}" rel="stylesheet">
	<link href="{{asset('assets/css/toastr.css')}}" rel="stylesheet">
	<link rel="stylesheet" href="{{asset("auth/alert.css")}}">
<link rel="stylesheet" href="{{asset("assets/css/style.css")}}">
<script>var base_url = "{{ url('/') }}";</script>

<title>Video Upload Web App</title>

</head>
<body>
	<div id="app">
		@include('includes.header')
		@yield('content')
		@include('includes.footer')
	</div>
	
@if(Session::has('success'))
<div class="custom-toast" id="custom-toast">
	<svg xmlns="http://www.w3.org/2000/svg" fill="none" class="toast-icon" viewBox="0 0 24 24" stroke="currentColor">
		<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
	</svg>
	<p class="toast-text">{{ Session::get('success') }}</p>
	<button id="close-button" onclick="closeToastPopup();" class="close-button">
		&#10005;
	</button>
</div>
@endif

@if(Session::has('error'))
<div class="custom-toast error-msg" id="custom-toast">
	<svg xmlns="http://www.w3.org/2000/svg" fill="none" class="toast-icon" viewBox="0 0 24 24" stroke="currentColor">
		<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
	</svg>
	<p class="toast-text">{{ Session::get('error') }}</p>
	<button id="close-button" onclick="closeToastPopup();" class="close-button">
		&#10005;
	</button>
</div>
@endif

	<style>

.photo-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(229px, 1fr));
  gap: 35px;
  padding-left:10px;
  padding-right:10px;
}
	  
		.photo-item {
		  display: flex;
		  flex-direction: column;
		  align-items: center;
		  text-align: center;
		}
	  
		.photo-image {
		  width: 100%;
		  height: auto;
		}
	  </style>
	  <script src="{{asset('auth/alert.js')}}" defer></script>
	  <script src="{{asset('assets/js/apiCall.js')}}" defer></script>
	  {{-- <script src="{{asset('assets/js/custom.js')}}"></script> --}}
	  <script src="{{asset('assets/js/toastr.min.js')}}"></script>
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
	  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
	  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
	  <script>
        $('body').on('submit', '#commentform', function(){
            var formData = new FormData(this);
            var ajaxurl = base_url+'/save-comment';
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
						window.location.reload();


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
	  @stack('script')
</body>
</html>