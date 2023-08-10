@extends('layouts.app')
@section('content')
    <!--wrapper-->
	<div class="wrapper">
		<div class="d-flex align-items-center justify-content-center my-5">
			<div class="container-fluid">
				<div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
					<div class="col mx-auto">
						<div class="card mb-0">
							<div class="card-body">
								<div class="p-4">
									<div class="mb-3 text-center">
										<img src="assets/images/logo-icon.png" width="60" alt="" />
									</div>
									<div class="text-center mb-4">
										<h5 class="">Rocker Admin</h5>
										<p class="mb-0">Please fill the below details to create your account</p>
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
									<div class="form-body">
										<form class="row g-3" action="{{route('save-user')}}"  method="POST" id="needs-validation" novalidate>
											<div class="col-12">
											<input type="hidden" name="_token" value="{{ csrf_token() }}">
												<label for="inputUsername" class="form-label">Username</label>
                                        <input type="text" class="form-control" id="username" name="username" placeholder="Please Enter Username" required>
											</div>
                                    <div class="col-12">
                                        <label for="inputEmailAddress" class="form-label">Email Address</label>
                                        <input type="email" class="form-control" id="email" name="email" placeholder="example@user.com" required>
                                    </div>
                                    <div class="col-12">
                                        <label for="inputChoosePassword" class="form-label">Password</label>
                                        <div class="input-group" id="show_hide_password" >
                                            <input type="password" class="form-control border-end-0" id="password" name="password" placeholder="Enter Password" required> <a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <label for="inputSelectCountry" class="form-label">Country</label>
                                        <select class="form-select" name="country" id="country" aria-label="Default select example" required>
											@foreach ($countries as $country)
											<option value="{{$country->id}}">{{$country->name}}</option>
										@endforeach
                                        </select>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" required>
                                            <label class="form-check-label" for="flexSwitchCheckChecked">I read and agree to Terms & Conditions</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="d-grid">
                                    <button type="submit" class="btn btn-primary">Sign up</button>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="text-center ">
                                            <p class="mb-0">Already have an account? <a href="{{route('login')}}">Sign in here</a></p>
                                        </div>
                                    </div>
										</form>
									</div>
									<div class="login-separater text-center mb-5"> <span>OR SIGN UP WITH EMAIL</span>
										<hr/>
									</div>
									<div class="list-inline contacts-social text-center">
										<a href="javascript:;" class="list-inline-item bg-facebook text-white border-0 rounded-3"><i class="bx bxl-facebook"></i></a>
										<a href="javascript:;" class="list-inline-item bg-twitter text-white border-0 rounded-3"><i class="bx bxl-twitter"></i></a>
										<a href="javascript:;" class="list-inline-item bg-google text-white border-0 rounded-3"><i class="bx bxl-google"></i></a>
										<a href="javascript:;" class="list-inline-item bg-linkedin text-white border-0 rounded-3"><i class="bx bxl-linkedin"></i></a>
									</div>

								</div>
							</div>
						</div>
					</div>
				 </div>
				<!--end row-->
			</div>
		</div>
	</div>
	<!--end wrapper-->
    @endsection