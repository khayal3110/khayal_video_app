@extends('layouts.app')
@section('content')
<!-- wrapper -->
<div class="wrapper">
    <div class="authentication-reset-password d-flex align-items-center justify-content-center">
     <div class="container">
        <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
            <div class="col mx-auto">
                <div class="card">
                    <div class="card-body">
                        <div class="p-4">
                            <div class="mb-4 text-center">
                                <img src="assets/images/logo-icon.png" width="60" alt="" />
                            </div>
                            <div class="text-start mb-4">
                                <h5 class="">Please enter the one time Code to verify your account</h5>
                                <p class="mb-0">
                                    <div> <span>A code has been sent to</span> </p>
                            </div>
                            @if ($errors->any())
                            <div class="alert alert-danger border-left-danger" role="alert">
                                <ul class="pl-4 my-2">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                            <form class="row g-3" method="POST" action="{{ route('veyfy-otp') }}" id="needs-validation" novalidate>
                            <div class="mb-3 mt-4 inputs d-flex flex-row justify-content-center mt-2">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input class="m-2 text-center form-control rounded verifyinput" type="text" name="otp[]" id="third" maxlength="1" required/>
                            <input class="m-2 text-center form-control rounded verifyinput" type="text" name="otp[]" id="fourth" maxlength="1" required/>
                            <input class="m-2 text-center form-control rounded verifyinput" type="text" name="otp[]" id="second" maxlength="1" required/>
                            <input class="m-2 text-center form-control rounded verifyinput" type="text" name="otp[]" id="fifth" maxlength="1" required/>
                            <input class="m-2 text-center form-control rounded verifyinput" type="text" name="otp[]" id="sixth" maxlength="1" required/>
                            <input class="m-2 text-center form-control rounded verifyinput" type="text" name="otp[]" id="first" maxlength="1" required/>
                            </div>
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">Otp Validate</button> <a href="{{route('login')}}"><i class='bx bx-arrow-back mr-1'></i>Back to Login</a>
                            </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </div>
</div>
{{-- <script>
    $(document).ready(function(){
        $(".verifyinput").keyup(function () {
            if (this.value.length == this.maxLength) {
                $(this).next('.verifyinput').focus();
            }
        });
    });  
</script> --}}
<!-- end wrapper -->
@endsection