<?php

if ($_SESSION) {

    if ($_POST) {

        $recipient = $_POST["recipient"];
        $sender = $_POST["sender"];
        $title = $_POST["title"];
        $message = $_POST["message"];

        if (!$recipient || !$title || !$message) {

            echo '<div class="hata">gerekli alanları doldurmanız gerekiyor...</div>';

        } else {

            $UserQuery = $DatabaseConnection->prepare("select * from users where user_name=? ");
            $UserQuery->execute(array($recipient));
            $NumberOfUser = $UserQuery->fetch(PDO::FETCH_ASSOC);
            $Users = $UserQuery->rowCount();

            if ($Users) {

                $MessageAdd = $DatabaseConnection->prepare("insert into messages set 
			
			            message_recipient=?,
						message_sender=?,
						message_title=?,
			            message_content=?
			");

                $MessageExecute = $MessageAdd->execute(array($NumberOfUser["user_id"], $sender, $title, $message));

                if ($MessageExecute) {

                    echo '<div class="warning-message-container">
                            <div class="warning-message-content"><i class="fas fa-exclamation"></i>Mesaj gönderildi.</div>;
                          </div>';

                    header("refresh: 2; url=?do=message");

                } else {

                    echo '<div class="warning-message-container">
                            <div class="warning-message-content"><i class="fas fa-exclamation"></i>Mesaj gönderirken bir hata oluştu</div>;
                          </div>';
                    header("refresh:2 url=?do=message_send");

                }

            } else {


                echo '<div class="warning-message-container">
                        <div class="warning-message-content"><i class="fas fa-exclamation"></i><span style="margin-right: 5px; color: red">' . $recipient . '</span><p> </p>isimli bir kullanıcı yok.</div>
                     </div>';
                header("refresh:5 url=?do=message_send");

            }

        }


    } else {


        ?>
        </div>
        <section class="user-edit">
            <div class="user-edit-container">
                <div class="user-edit-container-content">
                    <div class="user-edit-container-content-top">
                        <i class="far fa-edit"></i>
                        <h2>Send Message</h2>
                    </div>
                    <form action="" method="post">
                        <div class="user-edit-container-content-middle">
                            <div class="user-edit-container-content-middle-user-name">
                                <input name="recipient" type="text" placeholder="recipient">
                                <input name="sender" type="hidden" value="<?php echo $_SESSION["user"]; ?>">
                                <input name="title" type="text" placeholder="message title">
                                <textarea name="message" id="" rows="10" placeholder="your message"
                                ></textarea>
                            </div>
                        </div>
                        <div class="user-edit-container-content-bottom">
                            <div class="user-edit-container-content-bottom-button">
                                <button type="submit" class="btn">Send</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
        <?php

    }


} else {

    echo '<div class="warning-message-container">
                <div class="warning-message-content"><i class="fas fa-exclamation"></i>Opss üye olmadan mesaj gönderemezsin!</div>
              </div>';
    header("refresh:5 url=login.php");

}


?>