<?php //@ob_start(); @session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="">

    <!-- Css Style -->
    <link rel="stylesheet" href="./css/main.css">

    <title>Login Form</title>
</head>
<body>

    <?php
    $doLogin = @$_GET["doLogin"];

    switch ($doLogin) {

        case "users":
            include "memberLogin.php";
            break;

    }
    ?>

<div class="login-container">
    <h1>Login</h1>
    <form action="?doLogin=users" method="post">
        <div class="login-container-user">
            <input type="text" required placeholder="Username" name="users">
            <span></span>
        </div>
        <div class="login-container-pass">
            <input type="password" required placeholder="Password" name="password">
            <span></span>
        </div>
        <div class="login-container-pass-forg">
            Forgot Password?
        </div>
        <button class="login-btn">Login</button>
        <div class="login-container-singup">
            Not a member? <a href="signup.php">Sign-up</a>
        </div>
    </form>
</div>
</div>
</body>
</html>