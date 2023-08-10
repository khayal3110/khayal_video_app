@extends('layouts.app')
@section('content')
<!-- wrapper -->
<div class="wrapper">
    <div class="authentication-forgot d-flex align-items-center justify-content-center">
        <div class="card forgot-box">
            <div class="card-body">
                <div class="p-3">
                    <div class="text-center">
                        <img src="assets/images/icons/forgot-2.png" width="100" alt="" />
                    </div>
                    <h4 class="mt-5 font-weight-bold">Forgot Password?</h4>
                    <p class="text-muted">Enter your registered email ID to reset the password</p>
                   
                    <form class="row g-3" method="POST" action="{{ route('user-forgot-Password-post') }}" id="needs-validation" novalidate>
                    <div class="my-4">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <label class="form-label">Email id</label>
                        <input type="text" class="form-control" placeholder="Please Vaild Email Enter" required/>
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">Send</button>
                         <a href="{{route('login')}}" class="btn btn-light"><i class='bx bx-arrow-back me-1'></i>Back to Login</a>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end wrapper -->
@endsection