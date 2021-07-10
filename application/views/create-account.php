<div class="wrap-login100">
    <form class="login100-form validate-form" id="create_account" action="<?php echo base_url(); ?>welcome/create_account">
        <span class="login100-form-logo">
            <i class="zmdi zmdi-landscape"></i>
        </span>

        <span class="login100-form-title p-b-34 p-t-27">Create Your Account</span>

        <div class="notification"></div>

        <div class="wrap-input100 validate-input" data-validate="Enter Name">
            <input type="text" class="input100" name="name" placeholder="Enter Your Name">
            <span class="focus-input100" data-placeholder="&#xf207;"></span>
        </div>

        <div class="wrap-input100 validate-input" data-validate="Enter email">
            <input class="input100" type="email" name="email" placeholder="Enter Your Email">
            <span class="focus-input100" data-placeholder="&#xf207;"></span>
        </div>

        <div class="wrap-input100 validate-input" data-validate="Enter password">
            <input class="input100" type="password" name="password" placeholder="Password">
            <span class="focus-input100" data-placeholder="&#xf191;"></span>
        </div>

        <div class="wrap-input100 validate-input" data-validate="Enter phone number">
            <input class="input100" type="tel" name="phone" placeholder="Enter Your Phone Number">
            <span class="focus-input100" data-placeholder="&#xf191;"></span>
        </div>

        <div class="container-login100-form-btn">
            <button class="login100-form-btn" type="submit">Create Account</button>
        </div>

        <div class="text-center p-t-30">
            <a href="<?php echo base_url(); ?>" class="txt1">Already Have an Account? Login Here.</a>
        </div>
    </form>
</div>