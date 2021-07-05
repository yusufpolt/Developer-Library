<?php
if ($_SESSION) {
    $id = (int)$_GET["id"];

    $MessageQuery = $DatabaseConnection->prepare("select * from messages where message_id=? and message_recipient=?");
    $MessageQuery->execute(array($id, $_SESSION["id"]));
    $NumberOfMessage = $MessageQuery->fetch(PDO::FETCH_ASSOC);
    $Messages = $MessageQuery->rowCount();

    if ($Messages) {
        $MessageReadUpdate = $DatabaseConnection->prepare("update messages set message_read=? where message_id=? and message_recipient=?");
        $MessageReadUpdate->execute(array(1,$id,$_SESSION["id"]));
        ?>
        <section class="user-profile">
            <div class="user-profile-container">
                <div class="user-profile-container-content">
                    <div class="user-profile-container-content-top">
                        <div class="user-profile-container-content-top-title">
                            <h2><?php echo mb_substr($NumberOfMessage["message_title"], 0, 25); ?></h2>
                        </div>
                    </div>
                    <div class="user-profile-container-content-middle">
                        <div class="user-profile-container-content-middle-user">
                            <span><i class="far fa-user"></i><p>Sender : </p><?php echo $NumberOfMessage["message_sender"]; ?></span>
                        </div>
                        <div class="user-profile-container-content-middle-mail-content">
                            <span><i class="far fa-envelope"></i><p>Message : </p><?php echo $NumberOfMessage["message_content"]; ?></span>
                        </div>
                        <div class="user-profile-container-content-middle-user">
                            <span><i class="far fa-clock"></i><p>Message Date : </p><?php echo $NumberOfMessage["message_date"]; ?></span>
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
                <div class="warning-message-content"><i class="fas fa-exclamation"></i>Opss mesaj bulunamadı.</div>
              </div>';
    }
}