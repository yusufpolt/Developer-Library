<?php
!defined("index") ? die("hacking hee!!") : null;
include "settings/setting.php";

$id = $_GET["id"];
$SubjectQuery = $DatabaseConnection->prepare("select * from subjects inner join categories on categories.category_id = subjects.subject_category where subject_category=? order by subject_id desc");
$SubjectQuery->execute(array($id));
//Tümünü listele...
$NumberOfSubject = $SubjectQuery->fetchAll(PDO::FETCH_ASSOC);
$Subjects = $SubjectQuery->rowCount();


if ($Subjects) {

    ?>
    <section class="subjects">
        <div class="subject-container">
            <?php
            foreach ($NumberOfSubject as $item) {
                $CommentRow = $DatabaseConnection->prepare("select * from comments where comment_subject_id=?");
                $CommentRow->execute(array($item["subject_id"]));
                $NumberOfCommentsRow = $CommentRow->fetchAll(PDO::FETCH_ASSOC);
                $Comments = $CommentRow->rowCount();
                ?>
                <!--SUBJECT CONTAINER-->

                <div class="subject-container-content">
                    <div class="subject-container-content-top">
                        <div class="subject-container-content-top-image">
                            <img src="<?php echo $item["subject_image"]; ?>" alt="code">
                        </div>
                        <div class="subject-container-content-top-right">
                            <div class="subject-container-content-top-right-header">
                                <div class="subject-container-content-top-right-header-title">
                                    <h2><?php echo $item["subject_title"]; ?></h2>
                                </div>
                                <div class="subject-container-content-top-right-header-date">
                                    <i class="far fa-clock" style="margin-right: 10px"></i><?php echo $item["subject_date"]; ?>
                                </div>
                            </div>
                            <div class="subject-container-content-top-right-paragraph">
                                <?php echo mb_substr($item["subject_explanation"], 0, 500); ?>...
                            </div>
                        </div>
                    </div>
                    <div class="subject-container-content-button">
                        <button class="subject-container-content-button-more"><a
                                    href="?do=more&id=<?php echo $item["subject_id"]; ?>">More</a></button>
                    </div>
                    <div class="subject-container-content-bottom">
                        <div class="subject-container-content-bottom-border">
                            <span></span>
                        </div>
                        <div class="subject-container-content-bottom-writer">
                            <span><i class="fas fa-user-edit"></i> <?php echo $item["subject_owner"]; ?></span>
                        </div>
                        <div class="subject-container-content-bottom-category">
                            <span><i class="fas fa-laptop-code"></i> <?php echo $item["category_name"]; ?></span>
                        </div>
                        <div class="subject-container-content-bottom-reading">
                            <span><i class="far fa-eye"></i> <?php echo $item["subject_hit"]; ?> </span>

                        </div>
                        <div class="subject-container-content-bottom-comment">
                            <span><i class="far fa-comments"></i> <?php echo $Comments ?></span>
                        </div>
                    </div>
                </div>


                <?php
            }

            ?>
        </div>
    </section>
    <?php
} else {
    echo '<div class="error">Bu konuya ait hiç kategori bulunmamakta.</div>';
}

?>
