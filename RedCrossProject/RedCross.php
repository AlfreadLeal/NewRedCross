<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RedCross</title>
    <link rel="stylesheet" href="css/register.css">
</head>




<body>
    <section>
        <div class="container">
            <div class="user signinBx">
                <div class="imgBx">
                    <img src="img/redcrossph.png" alt="" />
                </div>
                <div class="formBx">
                    <form action="process/login.php" method="post">

                        <h2>Sign In</h2>
                        <input type="text" name="username" placeholder="Username" />
                        <input type="password" name="password" placeholder="Password" />
                        <input type="submit" value="Login" />

                        <!-- forgot password -->
                        <div class="forgot-password">
                            <a href="Forgotpassword.php">Forgot Password?</a>
                        </div>

                        <p class="signup">
                            NOT A MEMBER ?
                            <a href="#" onclick="toggleForm();">Sign Up.</a>
                        </p>
                        <div class="social-media">
                            <div class="fb"><img src="img/fblogo.png" title="Facebook Page" alt="" srcset=""></div>
                            <div class="ig"><img src="img/iglogo.png" title="Instagram Page" srcset=""></div>
                            <div class="twitter"><img src="img/twitterlogo.png" title="Twitter Page" alt="" srcset="">
                            </div>
                            <div class="redweb"><img src="img/redcrosslogo.png" title="Red Cross Website" srcset="">
                            </div>
                        </div>
                        <div class="follow-us">
                            <p>Follow us on our social media!</p>
                        </div>

                    </form>

                </div>

            </div>
            <div class="user signupBx">
                <div class="formBx">
                    <form action="process/register.php" method="post">
                        <h2>Create an account</h2>
                        <input type="text" name="firstname" placeholder="First Name" />
                        <input type="text" name="lastname" placeholder="Last Name" />
                        <input type="text" name="username" placeholder="Username" />
                        <input type="email" name="email" placeholder="Email Address" />
                        <!-- <input type="number" name="" placeholder="Contact Number" /> -->
                        <input type="text" name="password" placeholder="Create Password" />
                        <input type="text" name="confirm-password" placeholder="Confirm Password" />
                        <input type="submit" value="Sign Up" />
                        <p class="signup">
                            Already have an account ?
                            <a href="#" onclick="toggleForm();">Sign in.</a>
                        </p>
                    </form>
                </div>
                <div class="imgBx"><img src="img/redc.png" alt="" /></div>
            </div>
        </div>
    </section>

    <script src="javascript/register.js"></script>




</body>

</html>