</div>
</div>


<div id="dropDownSelect1"></div>

<!--===============================================================================================-->
<script src="<?php echo base_url(); ?>assets/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
<script src="<?php echo base_url(); ?>assets/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
<script src="<?php echo base_url(); ?>assets/vendor/bootstrap/js/popper.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
<script src="<?php echo base_url(); ?>assets/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
<script src="<?php echo base_url(); ?>assets/vendor/daterangepicker/moment.min.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
<script src="<?php echo base_url(); ?>assets/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
<script src="<?php echo base_url(); ?>assets/js/main.js"></script>

<!-- The core Firebase JS SDK is always required and must be listed first -->
<script src="https://www.gstatic.com/firebasejs/8.7.1/firebase-app.js"></script>

<!-- TODO: Add SDKs for Firebase products that you want to use
     https://firebase.google.com/docs/web/setup#available-libraries -->
<script src="https://www.gstatic.com/firebasejs/8.7.1/firebase-analytics.js"></script>

<!-- Add Firebase products that you want to use -->
<script src="https://www.gstatic.com/firebasejs/8.7.1/firebase-auth.js"></script>

<script>
    // Your web app's Firebase configuration
    // For Firebase JS SDK v7.20.0 and later, measurementId is optional
    var firebaseConfig = {
        apiKey: "AIzaSyB-ONKX5lhkoJPoNkR_Frlu_WGlfZs9tr8",
        authDomain: "phone-otp-21ccf.firebaseapp.com",
        projectId: "phone-otp-21ccf",
        storageBucket: "phone-otp-21ccf.appspot.com",
        messagingSenderId: "11189584120",
        appId: "1:11189584120:web:b8f4a0570c07c40d13bb0d",
        measurementId: "G-V55092GTVV"
    };
    // Initialize Firebase
    firebase.initializeApp(firebaseConfig);
    firebase.analytics();
</script>

<script>
    $('form').submit(function(e) {
        e.preventDefault();
        var form_id = $(this).attr('id');
        var submit_button_text = $('form#' + form_id + ' button[type="submit"]').val();
        window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('request_otp', {
            'size': 'invisible',
            'callback': (response) => {
                // reCAPTCHA solved, allow signInWithPhoneNumber.
                console.log('captcha solved');
            }
        });
        $.ajax({
            url: $(this).attr('action'),
            data: new FormData($('form#' + form_id)[0]),
            type: 'POST',
            dataType: 'JSON',
            processData: false,
            contentType: false,
            beforeSend: function() {
                $('form#' + form_id + ' button[type = "submit"]').append(' <i class="fa fa-spinner fa-spin"></i>');
                $('form#' + form_id + ' input[type = "submit"]').val('Sending...');
                $('form#' + form_id + ' button[type = "submit"]').attr('disabled', 'true');
                $('form#' + form_id + ' input[type = "submit"]').attr('disabled', 'true');
            },
            success: function(data) {
                $('form#' + form_id + ' button[type = "submit"] .fa-spinner').remove();
                $('form#' + form_id + ' input[type = "submit"]').val(submit_button_text);
                $('form#' + form_id + ' button[type = "submit"]').removeAttr('disabled', 'false');
                $('form#' + form_id + ' input[type = "submit"]').removeAttr('disabled', 'false');

                $('form#' + form_id + ' .notification').html('<div id="message" class="alert ' + data.class + ' alert-dismissible">' + data.message);

                if (data.class == 'alert-success') {
                    if (data.message === 'Sending OTP ...') {
                        //send OTP
                        const phoneNumber = $('form#' + form_id + ' input[name="phone"]').val();
                        const appVerifier = window.recaptchaVerifier;
                        firebase.auth().signInWithPhoneNumber(phoneNumber, appVerifier)
                            .then((confirmationResult) => {
                                // SMS sent. Prompt user to type the code from the message, then sign the
                                // user in with confirmationResult.confirm(code).
                                window.confirmationResult = confirmationResult;
                                $('form#' + form_id + ' .notification').html('<div id="message" class="alert ' + data.class + ' alert-dismissible">' + 'OTP has been sent to your Phone Number');
                                $('form#' + form_id + ' .d-none').removeClass('d-none');
                                $('form#' + form_id + ' input[type = "submit"]').val('Verify OTP');
                                $('form#' + form_id + ' button[type = "submit"]').html('Verify OTP');
                                $('form#' + form_id + ' button[type = "submit"]').attr('onClick', 'verify_otp(this.form.otp.value)');

                            }).catch((error) => {
                                // Error; SMS not sent
                                $('form#' + form_id + ' .notification').html('<div id="message" class="alert ' + data.class + ' alert-dismissible">' + error);
                                console.log(error);
                            });
                    } else {
                        $('form#' + form_id)[0].reset();
                    }
                }
            }
        })
    });

    function verify_otp(entered_otp) {
        const code = entered_otp;
        confirmationResult.confirm(code).then((result) => {
            // User signed in successfully.
            const user = result.user;
            alert('User Signed in Successfully');
        }).catch((error) => {
            // User couldn't sign in (bad verification code?)
            alert('OTP is Invalid');
            console.log(error);
        });
    }
</script>

</body>

</html>