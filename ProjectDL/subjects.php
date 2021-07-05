<?php
!defined("index") ? die("hacking hee!!") : null;
include "settings/setting.php";
//Sayfa
$Page = intval(@$_GET["page"]);
//Sayfa diye bir parametre yoksa eğer: birinci sayfada kal
if (!$Page) {
    $Page = 1;
}
$PageQuery = $DatabaseConnection->prepare("select * from subjects inner join categories on categories.category_id = subjects.subject_category inner join users on users.user_name=subjects.subject_owner");
$PageQuery->execute(array());
$NumberOfPage = $PageQuery->fetchAll(PDO::FETCH_ASSOC);
//Toplam konu sayısı
$Pages = $PageQuery->rowCount();
//Sayfa konu limiti
$PageLimit = 2;
$ShowPage = $Page * $PageLimit - $PageLimit;
$PageCount = ceil($Pages / $PageLimit);
$ForLimit = 2;

$SubjectQuery = $DatabaseConnection->prepare("select * from subjects inner join categories on categories.category_id = subjects.subject_category inner join users on users.user_name=subjects.subject_owner order by subject_id desc limit $ShowPage,$PageLimit");
$SubjectQuery->execute(array());
//Tümünü listele...
$NumberOfSubject = $SubjectQuery->fetchAll(PDO::FETCH_ASSOC);
$Subjects = 1;
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
                            <?php echo substr($item["subject_explanation"], 0, 500); ?>...
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
                        <span><i class="fas fa-user-edit"></i><a
                                    href="?do=profile&user=<?php echo $item["user_name"]; ?>"><?php echo $item["user_name"]; ?></a></span></span>
                    </div>
                    <div class="subject-container-content-bottom-category">
                        <span><i class="fas fa-laptop-code"></i> <a href="?do=categories&id=<?php echo $item["category_id"] ?>"><?php echo $item["category_name"]; ?></a></span>
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

        echo '<div class="subject-container-page-count">';

        for ($i = $Page - $ForLimit; $i < $Page + $ForLimit + 1; $i++) {

            if ($i > 0 && $i <= $PageCount) {

                if ($i == $Page) {

                    echo '<button class="subject-container-page-active">' . $i . '</button>';

                } else {

                    echo '<button class="subject-container-page-pages"><a href="?page=' . $i . '">' . $i . '</a></button>';

                }

            }


        }

        if ($Page != $PageCount) {


            echo '<button class="subject-container-page-last-button"><a href="?page=' . $PageCount . '">>></a></button>';

        }

        ?>
    </div>
</section>
<?php

?>

