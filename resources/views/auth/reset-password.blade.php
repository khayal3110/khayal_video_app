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
                                <h5 class="">Genrate New Password</h5>
                                <p class="mb-0">We received your reset password request. Please enter your new password!</p>
                            </div>
                            <form class="row g-3" method="post" id="needs-validation" novalidate>
                            <div class="mb-3 mt-4">
                                <label class="form-label">New Password</label>
                                <input type="text" class="form-control" placeholder="Enter new password" required/>
                            </div>
                            <div class="mb-4">
                                <label class="form-label">Confirm Password</label>
                                <input type="text" class="form-control" placeholder="Confirm password" required/>
                            </div>
                            <div class="d-grid gap-2">
                                <button type="button" class="btn btn-primary">Change Password</button> <a href="{{route('login')}}"><i class='bx bx-arrow-back mr-1'></i>Back to Login</a>
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
<!-- end wrapper -->
@endsection