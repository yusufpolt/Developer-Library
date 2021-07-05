<?php @session_start(); ob_start();?>
<?php
include "settings/setting.php";
if ($_POST) {
    $UserName = trim($_POST["users"]);
    $UserPassword = trim(md5($_POST["password"]));

    if (!$UserName || !$UserPassword) {

    } else {
        $UsersQuery = $DatabaseConnection->prepare("select * from users where user_name=? and user_password=?");
        $UsersQuery->execute(array($UserName,$UserPassword));
        $NumberOfUsers = $UsersQuery->fetch(PDO::FETCH_ASSOC);
        $Users = $UsersQuery->rowCount();

        if ($Users){

            $_SESSION["id"] = $NumberOfUsers["user_id"];
            $_SESSION["user"] = $NumberOfUsers["user_name"];
            $_SESSION["email"] = $NumberOfUsers["user_mail"];
            $_SESSION["rank"] = $NumberOfUsers["user_rank"];

            header("location:home.php");

        }else{
            echo "<div class='login-error'>Üye Adı ya da şifre hatalı</div>";
        }
    }

}

?>
