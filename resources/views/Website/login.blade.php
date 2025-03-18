@extends('Website.layouts.layout')
@section('content')
	<!--main area-->
	<main id="main" class="main-site left-sidebar">

		<div class="container">

			<div class="wrap-breadcrumb">
				<ul>
					<li class="item-link"><a href="#" class="link">home</a></li>
					<li class="item-link"><span>login</span></li>
				</ul>
			</div>
			<div class="row">
				<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 col-md-offset-3">
					<div class=" main-content-area">
						<div class="wrap-login-item ">
							<div class="login-form form-item form-stl">
								<form method="POST" action="{{ route('login') }}">
                                    @csrf
									<fieldset class="wrap-title">
										<h3 class="form-title">Log in to your account</h3>
									</fieldset>
									<fieldset class="wrap-input">
										<label for="frm-login-uname">Email Address:</label>
										<input id="Email" id="frm-login-uname" placeholder="Email Address" type="email" name="Email" :value="old('Email')" required autofocus autocomplete="username">
									</fieldset>
									<fieldset class="wrap-input">
										<label for="frm-login-pass">Password:</label>
										<input id="PasswordHash" id="frm-login-pass"
                                        type="password"
                                        name="PasswordHash"
                                        required autocomplete="current-password" placeholder="Enter your Password">
									</fieldset>

									<fieldset class="wrap-input">
										<label class="remember-field">
											<input class="frm-input " name="rememberme" id="rememberme" value="forever" type="checkbox"><span>Remember me</span>
										</label>
										<a class="link-function left-position" href="#" title="Forgotten password?">Forgotten password?</a>
									</fieldset>
                                    <x-primary-button class="btn btn-submit">
                                        {{ __('Log in') }}
                                    </x-primary-button>

									{{-- <input type="submit" class="btn btn-submit" value="Login" name="submit"> --}}
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
