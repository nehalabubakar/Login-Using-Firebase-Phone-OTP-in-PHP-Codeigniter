<div class="wrap-login100">
    <form class="login100-form validate-form" action="<?php echo base_url(); ?>welcome/login_using_phone" id="user_login">
        <span class="login100-form-logo">
            <i class="zmdi zmdi-landscape"></i>
        </span>

        <span class="login100-form-title p-b-34 p-t-27">Login Using Phone Number</span>

        <div class="notification"></div>

        <div class="wrap-input100 validate-input" data-validate="Enter phone number">
            <input class="input100" type="tel" name="phone" placeholder="Enter Your Phone Number">
            <span class="focus-input100" data-placeholder="&#xf207;"></span>
        </div>

        <div class="wrap-input100 validate-input d-none" data-validate="Enter OTP">
            <input class="input100" type="text" name="otp" placeholder="Enter Your OTP">
            <span class="focus-input100" data-placeholder="&#xf191;"></span>
        </div>

        <div id="recaptcha-container"></div>

        <div class="container-login100-form-btn">
            <button class="login100-form-btn" type="submit" id="request_otp">Send OTP</button>
        </div>

        <div class="text-center p-t-30">
            <a class="txt1 float-left" href="<?php echo base_url(); ?>create-account">Create Account?</a>
            <a class="txt1 float-right" href="<?php echo base_url(); ?>">Login Using Email & Password</a>
        </div>
    </form>
</div>