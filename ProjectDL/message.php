<?php

if ($_SESSION) {
    $MessageQuery = $DatabaseConnection->prepare("select * from messages where message_recipient=? order by message_id desc");
    $MessageQuery->execute(array($_SESSION["id"]));
    $NumberOfMessage = $MessageQuery->fetchAll(PDO::FETCH_ASSOC);
    $Messages = $MessageQuery->rowCount();
    echo '<div class="message-title">
                        <div class="message-title-container">
                            <div class="message-title-container-content">
                                <h1>Message</h1>
                                <span><i class="far fa-edit"></i><a href="?do=message_send">Send Message</a></span>
                            </div>
                        </div>
                       </div>';
    //Eğer böyle bir mesaj varsa
    if ($Messages) {

        foreach ($NumberOfMessage as $MessageItem) {
            if ($MessageItem["message_recipient"] == $_SESSION["id"]) {

                if ($MessageItem["message_read"] == 1) {
                    ?>
                    <div class="message">
                        <div class="message-container">
                            <div class="message-container-content">
                                <a href="?do=message_read&id=<?php echo $MessageItem["message_id"] ?>"
                                   class="message-box-container">
                                    <div class="message-box-left message-box">
                                        <i class="fas fa-user-edit"></i>
                                        <p>Sender : </p>
                                        <span><?php echo $MessageItem["message_sender"]; ?></span>
                                    </div>
                                    <div class="message-box-left message-box">
                                        <i class="fas fa-paper-plane"></i>
                                        <p>Title : </p>
                                        <span><?php echo $MessageItem["message_title"]; ?></span>
                                    </div>
                                    <div class="message-box-right message-box">
                                        <i class="fas fa-clock"></i>
                                        <p>Date : </p>
                                        <span><?php echo $MessageItem["message_date"]; ?></span>
                                    </div>
                                    <div class="message-box-right">
                                        <button class="message-box-delete">
                                            <a href="?do=message_delete&id=<?php echo $MessageItem["message_id"]; ?>">delete</a>
                                        </button>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php
                } else {
                    ?>
                    <div class="message">
                        <div class="message-container" style="background: #a6a6a6">
                            <div class="message-container-content">
                                <a href="?do=message_read&id=<?php echo $MessageItem["message_id"] ?>"
                                   class="message-box-container">
                                    <div class="message-box-left message-box">
                                        <i class="fas fa-user-edit"></i>
                                        <p>Sender : </p>
                                        <span><?php echo $MessageItem["message_sender"]; ?></span>
                                    </div>
                                    <div class="message-box-left message-box">
                                        <i class="fas fa-paper-plane"></i>
                                        <p>Title : </p>
                                        <span><?php echo $MessageItem["message_title"]; ?></span>
                                    </div>
                                    <div class="message-box-right message-box">
                                        <i class="fas fa-clock"></i>
                                        <p>Date : </p>
                                        <span><?php echo $MessageItem["message_date"]; ?></span>
                                    </div>
                                    <div class="message-box-right">
                                        <button class="message-box-delete">
                                            <a href="?do=message_delete">delete</a>
                                        </button>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php
                }


            } else {
                '<div class="warning-message-container">
                             <div class="warning-message-content"><i class="fas fa-exclamation"></i>Opps beklenmeyen bir hata oldu.</div>
                          </div>';
            }
        }

    } else {
        echo '<div class="warning-message-container">
                             <div class="warning-message-content"><i class="fas fa-exclamation"></i>Hiç mesajınız bulunmuyor.</div>
                          </div>';
    }
}