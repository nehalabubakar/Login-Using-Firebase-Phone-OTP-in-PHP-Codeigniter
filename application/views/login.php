<div class="wrap-login100">
	<form class="login100-form validate-form" action="<?php echo base_url(); ?>welcome/login" id="user_login">
		<span class="login100-form-logo">
			<i class="zmdi zmdi-landscape"></i>
		</span>

		<span class="login100-form-title p-b-34 p-t-27">Log in</span>

		<div class="notification"></div>

		<div class="wrap-input100 validate-input" data-validate="Enter email">
			<input class="input100" type="email" name="email" placeholder="Enter Your Email">
			<span class="focus-input100" data-placeholder="&#xf207;"></span>
		</div>

		<div class="wrap-input100 validate-input" data-validate="Enter password">
			<input class="input100" type="password" name="password" placeholder="Enter Your Password">
			<span class="focus-input100" data-placeholder="&#xf191;"></span>
		</div>

		<div class="contact100-form-checkbox">
			<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
			<label class="label-checkbox100" for="ckb1">Remember me</label>
		</div>

		<div class="container-login100-form-btn">
			<button class="login100-form-btn" type="submit">Login</button>
		</div>

		<div class="text-center p-t-30">
			<a class="txt1 float-left" href="<?php echo base_url(); ?>create-account">Create Account?</a>
			<a class="txt1 float-right" href="<?php echo base_url(); ?>login-using-phone">Login Using Phone Number</a>
		</div>
	</form>
</div>