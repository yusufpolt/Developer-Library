<?php ob_start(); ?>
<?php
!defined("index") ? die("hacking hee!!") : null;
include "settings/setting.php";
$id = $_GET["id"];
$SubjectQuery = $DatabaseConnection->prepare("select * from subjects inner join categories on categories.category_id = subjects.subject_category  where subject_id=?");
$SubjectQuery->execute(array($id));
//Tümünü listele...
$NumberOfSubject = $SubjectQuery->fetchAll(PDO::FETCH_ASSOC);
$Subjects = 1;


//Subject Hit
if (!@$_COOKIE["SubjectHit" . $id]) {
    $SubjectHit = $DatabaseConnection->prepare("update subjects set subject_hit = subject_hit + 1 where subject_id=?");
    $SubjectHit->execute(array($id));

    setcookie("SubjectHit" . $id, " ", time() + 9999999999999999999);
}


foreach ($NumberOfSubject as $item) {
    $CommentRow = $DatabaseConnection->prepare("select * from comments where comment_subject_id=?");
    $CommentRow->execute(array($item["subject_id"]));
    $NumberOfCommentsRow = $CommentRow->fetchAll(PDO::FETCH_ASSOC);
    $Comments = $CommentRow->rowCount();
    ?>
    <!--SUBJECT CONTAINER-->
    <section class="subjects">
        <div class="subject-container">
            <div class="subject-container-content">
                <div class="subject-container-content-top">
                    <div class="subject-container-content-top-right">
                        <div class="subject-container-content-top-image-more">
                            <img src="<?php echo $item["subject_image"]; ?>" alt="code">
                        </div>
                        <div class="subject-container-content-top-right-header">
                            <div class="subject-container-content-top-right-header-title">
                                <h2><?php echo $item["subject_title"]; ?></h2>
                            </div>
                            <div class="subject-container-content-top-right-header-date">
                                <i class="far fa-clock" style="margin-right: 10px"></i><?php echo $item["subject_date"]; ?>
                            </div>
                        </div>
                        <div class="subject-container-content-top-right-paragraph">
                            <?php echo nl2br($item["subject_explanation"]); ?>
                        </div>
                    </div>
                </div>
                <div class="subject-container-content-bottom">
                    <div class="subject-container-content-bottom-border">
                        <span></span>
                    </div>
                    <div class="subject-container-content-bottom-writer">
                        <span><i class="fas fa-user-edit"></i> <?php echo $item["subject_owner"]; ?></span>
                    </div>
                    <div class="subject-container-content-bottom-category">
                        <span><i class="fas fa-laptop-code"></i> <?php echo $item["category_name"]; ?> </span>
                    </div>
                    <div class="subject-container-content-bottom-reading">
                        <span><i class="far fa-eye"></i> <?php echo $item["subject_hit"]; ?> </span>
                    </div>
                    <div class="subject-container-content-bottom-comment">
                        <span><i class="far fa-comments"></i> <?php echo $Comments ?></span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php

}


$CommentsQuery = $DatabaseConnection->prepare("select * from comments where comment_subject_id=?");
$CommentsQuery->execute(array($id));
$NumberOfComments = $CommentsQuery->fetchALL(PDO::FETCH_ASSOC);
$Comments = $CommentsQuery->rowCount();

if ($Comments) {

    foreach ($NumberOfComments as $CommentsItem) {

        ?>

        <div class="comments">
            <div class="comments-container">
                <div class="comments-container-top">
                    <div class="comments-container-top-date">
                        <i class="far fa-clock" style="margin-right: 10px"></i><?php echo $CommentsItem["comment_date"]; ?>
                    </div>
                </div>
                <div class="comments-container-content">
                    <div class="comments-container-content-left">
                        <div class="comments-container-content-img">
                            <img src="./img/profileaction.jpg" alt="">
                        </div>
                        <div class="comments-container-user-name">
                            <?php echo $CommentsItem["comment_add"]; ?>
                        </div>
                    </div>
                    <div class="comments-container-content-right">
                        <div class="comments-container-content-comments-area">
                            <span><?php echo $CommentsItem["comment_message"]; ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- </div>
        <div class="yorumlar">
            <h2>ekleyen : <?php echo $CommentsItem["comment_add"]; ?>
                <span style="float:right;">tarih: <?php echo $CommentsItem["comment_date"]; ?> </span></h2>
            <p>
                <?php echo $CommentsItem["comment_message"]; ?>
            </p>
        </div> -->
        <?php


    }


} else {

    echo '<div class="comment-empty-container">
            <div class="comment-empty-content"><i class="fas fa-comment-slash"></i>Henuz bu konuya hiç yorum eklenmemiş.</div>
        </div>';


}


if ($_POST) {

    $name = trim($_POST["name"]);
    $mail = trim($_POST["mail"]);
    $message = $_POST["message"];

    if (!$message || !$mail || !$name) {

        echo '<div class="comment-empty-container">
                <div class="comment-empty-content"><i class="fas fa-exclamation"></i>Yorum alanı boş geçilemez.</div>
              </div>';

        $url = $_SERVER["HTTP_REFERER"];

        header("Refresh:5; url=$url");

    } else {

        $AddComment = $DatabaseConnection->prepare("insert into comments set 
		
		          comment_add=?,
				  comment_mail=?,
				  comment_message=?,
				  comment_subject_id=?
		
		");

        $AddComments = $AddComment->execute(array($name, $mail, $message, $id));

        if ($AddComments) {


//            echo '<div class="basarili2">yorumunuz basarıyla eklendi yonlendiriliyorsunuz</div>';

            $url = $_SERVER["HTTP_REFERER"];

            header("Refresh:0; url=$url");


        } else {

            echo '
              <div class="comment-empty-container">
                <div class="comment-empty-content"><i class="fas fa-exclamation"></i>Yorum eklenirken bir hata oluştu.</div>
              </div>';

        }
    }


} else {

    if ($_SESSION) {

        ?>
        <section class="comments-form">´
            <form action="" method="post">
                <div class="comments-form-container">
                    <div class="comments-form-container-content">
                        <div class="comments-form-container-content-top">
                            <div class="comments-form-content-top-image">

                                <img src="./img/profileaction.jpg" alt="">
                                <p><?php echo $_SESSION["user"]; ?></p>
                                <li><input type="hidden" value="<?php echo $_SESSION["user"]; ?>" name="name"/></li>
                                <li><input type="hidden" value="<?php echo $_SESSION["email"]; ?>" name="mail"/></li>
                            </div>
                            <div class="comments-form-content-top-comment">
                        <textarea placeholder="Write a Comment..." name="message" id="" cols="30" rows="10"
                                  placeholder></textarea>
                            </div>
                        </div>
                        <div class="comments-form-content-button">
                            <button type="submit" class="btn">Send</button>
                        </div>
                    </div>
                </div>
            </form>
        </section>

        <?php


    } else {

        ?>
        <div style="font-size:19px;padding:10px;">Write a Comment</div>
        <div class="sol2">
            <form action="" method="post">
                <ul>
                    <li>Name</li>
                    <li><input type="text" name="name"/></li>
                    <li>Email</li>
                    <li><input type="text" name="mail"/></li>


                    <li><textarea name="message" id="" cols="50" rows="10"></textarea></li>

                    <li>
                        <button type="submit">Send</button>
                    </li>
                </ul>
            </form>
        </div>
        <?php

    }

}

?>
<?php ob_flush(); ?>