<!doctype html>
<html lang="en">
<?php include 'layouts/header.php'  ?>
<body>
<div class="wrapper login-wrapper">

    <div class="content">
        <div class="login-form">
            <div class="title"><span>Login</span></div>
            <form action="dashboard.php" method="post">
                <div class="row d-flex justify-content-start">
                    <i class="fas fa-envelope"></i>
                    <input type="email" name="email" placeholder="Email" required>
                </div>

                <div class="row d-flex justify-content-start">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="pass" placeholder="Password" required>
                </div>

                <div class="forgetpass d-flex justify-content-end"><a href="#">Forgot password?</a></div>

                <div class="row button">
                    <input type="submit" name="login" value="Login">
                </div>

    <!--    <div class="signup-link">Not a member? <a href="#">Signup now</a></div>-->
            </form>
        </div>
    </div>

</div>

</body>
</html>