<?php @session_start(); ob_start();?>
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

    <title>Sing-up Form</title>
</head>
<body>

<?php
$doSignup = @$_GET["doSignup"];

switch ($doSignup) {

    case "signup":
        include "memberSignup.php";
        break;

}
?>

<div class="login-container">
    <h1>Sign-up</h1>
    <form action="?doSignup=signup" method="post">
        <div class="login-container-user">
            <input type="text" required placeholder="Username" name="name">
            <span></span>
        </div>
        <div class="login-container-pass">
            <input type="password" required placeholder="Password" name="password">
            <span></span>
        </div>
        <div class="login-container-email">
            <input type="email" required placeholder="Email" name="mail">
            <span></span>
        </div>
        <button class="login-btn">Sign-up</button>
        <div class="login-container-singup">
            Are you a member? <a href="login.php">Login</a>
        </div>
    </form>
</div>
</body>
</html>