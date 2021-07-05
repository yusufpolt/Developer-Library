<?php @session_start();
ob_start(); ?>
<?php include "settings/setting.php"; ?>
<?php
if (!$_SESSION) {
    if ($_POST) {
        $name = strip_tags(trim($_POST["name"]));
        $password = strip_tags(trim(md5($_POST["password"])));
        $mail = trim($_POST["mail"]);

        if (!$name || !$password || !$mail) {

            echo '<div class="login-error">Lütfen tüm alanları doldurunuz.</div>';

        } elseif (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {

            echo '<div class="login-error">Lütfen geçerli bir mail adresi giriniz.</div>';

        } else {

            $UsersQuery = $DatabaseConnection->prepare("select * from users where user_name=?");
            $UsersQuery->execute(array($name));
            $NumberOfUsers = $UsersQuery->fetch(PDO::FETCH_ASSOC);
            $Users = $UsersQuery->rowCount();

            if ($Users) {
                echo '<div class="login-error">Farklı bir kullanıcı adı giriniz.</div>';
            } else {
                $UserAdd = $DatabaseConnection->prepare("insert into users set 
                user_name=?,
                user_password=?,
                user_mail=?
");
                $UserAddCheck = $UserAdd->execute(array($name, $password, $mail));
                if ($UserAddCheck) {
                    echo '<div class="login-error">Kayıt işlemi başarılı.</div>';
                    header("refresh:2; url=login.php");
                } else {
                    echo '<div class="login-error">Kayıt işlemi sırasında beklenmedik bir hata gerçekleşti.</div>';
                }
            }
        }
    } else {
        header("location:home.php");
    }
}
?>