<?php
include 'config.php';

if (isset($_POST['submit'])) {

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = md5($_POST['password']);
    $cpass = md5($_POST['cpassword']);

    $select_users = mysqli_query($conn, "SELECT * FROM users 
   WHERE email = '$email' AND password = '$pass'");

    if (mysqli_num_rows($select_users) > 0) {
        $message = 'User Already Exist!';
    } else {
        if ($pass != $cpass) {
            $message = 'Confirm Password Not Matched!';
        } else {
            mysqli_query($conn, "INSERT INTO users (name, email,
      password) VALUES('$name', '$email', '$cpass')");
            $message = 'Registered Successfully!';
            header('location:login.php');
        }
    }
}
?>







<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign Up </title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="r.ass/fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="r.ass/css/style.css">
</head>

<body>

    <div class="main">

        <section class="signup">
            <div class="container">
                <div class="signup-content">
                    <form method="POST" id="signup-form" class="signup-form">
                        <h2 class="form-title">Create Account</h2>

                        <?php if (isset($message)) {
                            echo "<script>alert('$message');</script>";
                        } ?>

                        <div class="form-group">
                            <input type="text" class="form-input" name="name" id="name"
                                placeholder=" Enter Your Name" />
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-input" name="email" id="email"
                                placeholder=" Enter Your Email" />
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-input" name="password" id="password"
                                placeholder="Enter Your Password" />
                            <span toggle="#password" class="zmdi zmdi-eye field-icon toggle-password"></span>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-input" name="cpassword" id="re_password"
                                placeholder="Confirm Your Password" />
                            <span toggle="#password" class="zmdi zmdi-eye field-icon toggle-password"></span>

                        </div>
                        <div class="form-group">
                            <input type="submit" name="submit" id="submit" class="form-submit" value=" Sign up" />
                        </div>
                    </form>
                    <p class="loginhere">
                        Have already an account ? <a href="login.php" class="loginhere-link">Login Now</a>
                    </p>
                </div>
            </div>
        </section>

    </div>

    <!-- JS -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="r.ass/js/main.js"></script>
</body>

</html>