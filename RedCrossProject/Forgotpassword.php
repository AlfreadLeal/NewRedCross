<link rel="stylesheet" href="css/forgot.css">

<section>
    <div class="container">
        <div class="user signinBx">
            <div class="imgBx"><img src="img/redc.png" alt="" /></div>

            <div class="formBx">
                <!-- error message areh either "Invalid Email or Email not registered" -->
                <div class="error-message">
                    <p> Email Address Invalid </p>
                </div>
                <!-- ends here -->
                <form action="process/forgotpassword.php" method="post">

                    <div class="inside-container">
                        <div class="reset-message">
                            <h2>Reset Password</h2>
                        </div>

                        <div class="input-email">
                            <input type="text" name="email" placeholder="Enter Registered Email" />
                        </div>

                        <div class="submit-email">
                            <input type="submit" value="Send Code" />
                        </div>
                    </div>

                </form>

            </div>

        </div>

    </div>
</section>

<script src="javascript/register.js"></script>




</body>