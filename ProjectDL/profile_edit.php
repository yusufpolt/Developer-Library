<?php !defined("index") ? die("hacking hee!!") : null; ?>
<?php

if ($_SESSION) {
    $user = @$_GET["user"];
    if ($_SESSION["user"] == $user) {

        $UserQuery = $DatabaseConnection->prepare("select * from users where user_name=?");
        $UserQuery->execute(array($user));
        $NumberOfUser = $UserQuery->fetch(PDO::FETCH_ASSOC);
        $Users = $UserQuery->rowCount();

        if ($Users) {

            if ($_POST) {

                $mail = strip_tags(trim($_POST["mail"]));
                $password = strip_tags(trim($_POST["password"]));
                $about = strip_tags($_POST["about"]);

                if (!$mail) {

                    echo '<div class="warning-message-container">
                             <div class="warning-message-content"><i class="fas fa-exclamation"></i>Mail boş geçilemez.</div>
                          </div>';
                    header("refresh:2 url=?do=profile_edit&user=$user");
                } elseif (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
                    echo '<div class="warning-message-container">
                             <div class="warning-message-content"><i class="fas fa-exclamation"></i>Lütfen geçerli bir mail adresi giriniz.</div>
                          </div>';

                    header("refresh:2 url=?do=profile_edit&user=$user");

                } else {
                    if ($password) {
                        $password = md5($password);
                    } else {
                        $password = $NumberOfUser["user_password"];
                    }

                    $UpdateUser = $DatabaseConnection->prepare("update users set
                    user_mail=?,
                    user_password=?,
                    user_about=? where user_name=?                      
                    ");

                    $UpdateUserExecute = $UpdateUser->execute(array($mail, $password, $about, $_SESSION["user"]));
                    if ($UpdateUserExecute) {

                        echo '<div class="warning-message-container">
                             <div class="warning-message-content"><i class="fas fa-exclamation"></i>Profile Güncellendi.</div>
                          </div>';

                        header("refresh:2 url=?do=profile&user=$user");

                    } else {
                        echo '<div class="warning-message-container">
                             <div class="warning-message-content"><i class="fas fa-exclamation"></i>Mail boş geçilemez.</div>
                          </div>';
                    }
                }

            } else {

                ?>
                <section class="user-edit">
                    <div class="user-edit-container">
                        <div class="user-edit-container-content">
                            <div class="user-edit-container-content-top">
                                <i class="far fa-edit"></i>
                                <h2>Profile Edit</h2>
                            </div>
                            <form action="" method="post">
                                <div class="user-edit-container-content-middle">
                                    <div class="user-edit-container-content-middle-user-name">
                                        <input type="text" disabled="disabled" placeholder="name"
                                               value="<?php echo $NumberOfUser["user_name"]; ?>">
                                        <input name="password" type="password" placeholder="change password">
                                        <input name="mail" type="text" placeholder="mail"
                                               value="<?php echo $NumberOfUser["user_mail"]; ?>">
                                        <textarea name="about" id="" rows="10" placeholder="about me"
                                                  value=""><?php echo $NumberOfUser["user_about"]; ?></textarea>
                                    </div>
                                </div>
                                <div class="user-edit-container-content-bottom">
                                    <div class="user-edit-container-content-bottom-button">
                                        <button type="submit" class="btn">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </section>
                <?php
            }

        } else {
            echo '
              <div class="warning-message-container">
                <div class="warning-message-content"><i class="fas fa-exclamation"></i>Üye bulunamadı.</div>
              </div>';
        }

    } else {
        echo '
              <div class="warning-message-container">
                <div class="warning-message-content"><i class="fas fa-exclamation"></i>Hoppp dur orada bakalım.</div>
              </div>';

    }
}