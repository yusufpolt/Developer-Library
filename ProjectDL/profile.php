<?php !defined("index") ? die("hacking hee!!") : null; ?>
<?php //@session_start(); ?>
<?php

if ($_SESSION) {
    $user = @$_GET["user"];

    $UserQuery = $DatabaseConnection->prepare("select * from users where user_name=?");
    $UserQuery->execute(array($user));
    $NumberOfUser = $UserQuery->fetch(PDO::FETCH_ASSOC);
    $Users = $UserQuery->rowCount();

    if ($Users) {
        ?>
        <section class="user-profile">
            <div class="user-profile-container">
                <div class="user-profile-container-content">
                    <div class="user-profile-container-content-top">
                        <div class="user-profile-container-content-top-title">
                            <h2>Profile</h2>
                            <?php
                            if ($_SESSION["user"] == $user) {
                                echo '<span><i class="far fa-edit"></i><a
                                        href="?do=profile_edit&user=' . $_SESSION["user"] . '">Edit Profile</a></span>';
                            }
                            ?>
                        </div>
                    </div>
                    <div class="user-profile-container-content-middle">
                        <div class="user-profile-container-content-middle-user">
                            <span><i class="far fa-user"></i><p>User Name : </p><?php echo $NumberOfUser["user_name"]; ?></span>
                        </div>
                        <div class="user-profile-container-content-middle-user">
                            <span><i class="far fa-envelope"></i><p>Mail Address : </p><?php echo $NumberOfUser["user_mail"]; ?></span>
                        </div>
                        <div class="user-profile-container-content-middle-user">
                            <span><i class="far fa-address-card"></i><p>About Me : </p><?php echo $NumberOfUser["user_about"]; ?></span>
                        </div>
                        <div class="user-profile-container-content-middle-user">
                            <span><i class="far fa-clock"></i><p>Registration of Date : </p><?php echo $NumberOfUser["date_of_registration"]; ?></span>
                        </div>
                    </div>
                    <div class="user-profile-container-container-content-bottom">

                    </div>
                </div>
            </div>
        </section>
        <?php

    } else {
        echo '<div class="warning-message-container">
                <div class="warning-message-content"><i class="fas fa-exclamation"></i>Kullanıcı bulunamadı.</div>
              </div>';
    }
} else {
    echo '<div class="warning-message-container">
                <div class="warning-message-content"><i class="fas fa-exclamation"></i>Bu alanı görebilmek için lütfen üye olun.</div>
              </div>';
}