@extends('Website.layouts.layout')
@section('content')
	<!--main area-->
	<main id="main" class="main-site left-sidebar">

		<div class="container">

			<div class="wrap-breadcrumb">
				<ul>
					<li class="item-link"><a href="#" class="link">home</a></li>
					<li class="item-link"><span>Profile</span></li>
				</ul>
			</div>
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>

            @endif
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>

            @endif
			<div class="row">
				<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 col-md-offset-3">
					<div class="main-content-area">
						<div class="wrap-login-item">
							<div class="register-form form-item">
								<form class="form-stl" action="{{ route('profile.update') }}" method="POST">
									@csrf
									@method('PUT')
									<fieldset class="wrap-title">
										<h3 class="form-title">Edit your account</h3>
										<h4 class="form-subtitle">Personal information</h4>
									</fieldset>
									<fieldset class="wrap-input">
										<label for="frm-reg-fname">First Name*</label>
										<input type="text" id="frm-reg-fname" name="FirstName" placeholder="First name*" value="{{ auth()->user()->FirstName }}">
									</fieldset>

									<fieldset class="wrap-input">
										<label for="frm-reg-lname">Last Name*</label>
										<input type="text" id="frm-reg-lname" name="LastName" placeholder="Last name*" value="{{ auth()->user()->LastName }}">
									</fieldset>

									<fieldset class="wrap-input">
										<label for="frm-reg-email">Email*</label>
										<input type="email" id="frm-reg-email" name="Email" placeholder="Email*" value="{{ auth()->user()->Email }}">
									</fieldset>

									<fieldset class="wrap-input">
										<label for="frm-reg-city">City*</label>
										<select name="City" id="frm-reg-city">
											@foreach($cities as $city)
												<option value="{{ $city->ProvinceID }}" {{ auth()->user()->ProvinceID == $city->ProvinceID ? 'selected' : '' }}>{{ $city->City }}</option>
											@endforeach
										</select>
									</fieldset>

									<fieldset class="wrap-input">
										<label for="frm-reg-address">Address*</label>
										<input type="text" id="frm-reg-address" name="Address" placeholder="Address*" value="{{ auth()->user()->Address }}">
									</fieldset>

									<fieldset class="wrap-input">
										<label for="frm-reg-phone">PhoneNumber*</label>
										<input type="text" id="frm-reg-phone" name="PhoneNumber" placeholder="PhoneNumber*" value="{{ auth()->user()->PhoneNumber }}">
									</fieldset>

									<input type="submit" class="btn btn-sign" value="Update" name="update">
								</form>
							</div>
						</div>
					</div><!--end main products area-->
				</div>
			</div><!--end row-->

		</div><!--end container-->

	</main>
	<!--main area-->
@endsection

