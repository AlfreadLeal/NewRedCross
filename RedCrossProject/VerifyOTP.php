<link rel="stylesheet" href="css/forgot.css">

<section>
    <div class="container">
        <div class="user signinBx">

            <div class="imgBx"><img src="img/redc.png" alt="" /></div>
            <div class="formBx">
                <!-- error message area -->
                <div class="error-message">
                    <p>Email Address Invalid</p>
                </div>
                <!-- ends here -->
                <form action="process/verifyOTP.php" method="post">
                    <!-- OTP Section (Initially Hidden) -->
                    <div class="otp-container">
                        <div class="otp-message">
                            <h2>Enter Your OTP Here</h2>
                            <!-- <p id="otp-timer">This OTP will only be available for <span id="timer">1:00</span></p> -->
                        </div>
                        <div class="input-otp">
                            <input type="text" name="ver-otp" placeholder="Enter OTP" />
                        </div>
                        <div class="submit-otp">
                            <input type="submit" value="Submit OTP" />
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</section>