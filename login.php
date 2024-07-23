<?php

include 'config.php';
session_start();

if (isset($_POST['submit'])) {

    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = md5($_POST['password']);

    $select_users = mysqli_query($conn, "SELECT * FROM users WHERE 
email = '$email' AND password = '$pass'");

    if (mysqli_num_rows($select_users) > 0) {

        $row = mysqli_fetch_assoc($select_users);
        if ($row['user_type'] == 'admin') {

            $_SESSION['admin_name'] = $row['name'];
            $_SESSION['admin_email'] = $row['email'];
            $_SESSION['admin_id'] = $row['id'];
            header('location:admin-home.php');

        } elseif ($row['user_type'] == 'user') {

            $_SESSION['user_name'] = $row['name'];
            $_SESSION['user_email'] = $row['email'];
            $_SESSION['user_id'] = $row['id'];
            header('location:index.php');
        }

    } else {
        $message = "Wrong Email Or Password";
    }
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login SADEEN Shop </title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="r.ass/fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="r.ass/css/style.css">
</head>

<body>
    <?php
    if (isset($message)) {

        echo $message;

    }
    ?>

    <div class="main">

        <section class="signup">
            <div class="container">
                <div class="signup-content">
                    <form method="POST" id="signup-form" class="signup-form">
                        <h2 class="form-title">LOGIN NOW</h2>
                        <div class="form-group">
                            <input type="email" class="form-input" name="email" id="email"
                                placeholder="Enter Your Email" required />
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-input" name="password" id="password"
                                placeholder="Enter Your Password" required />
                            <span toggle="#password" class="zmdi zmdi-eye field-icon toggle-password"></span>

                        </div>
                        <div class="form-group">
                            <input type="submit" name="submit" id="submit" class="form-submit" value="Login Now" />
                        </div>
                    </form>
                    <p class="loginhere">
                        Don't Have An Account ? <a href="register.php" class="loginhere-link">Register Now</a>
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