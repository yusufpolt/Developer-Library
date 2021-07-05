<?php !defined("index") ? die("hacking hee!!") : null; ?>
<?php

if ($_SESSION) {
    if ($_POST) {
        $title = strip_tags(trim($_POST["title"]));
        $image = strip_tags(trim($_POST["image"]));
        $category = $_POST["category"];
        $text = strip_tags($_POST["text"]);

        if (!$title || !$image || !$text) {
            echo '<div class="warning-message-container">
                <div class="warning-message-content"><i class="fas fa-exclamation"></i>Lütfen tüm alanları doldurunuz.</div>
              </div>';
            header("refresh:2 url=?do=subject_add");
        } else {
            $SubjectsQuery = $DatabaseConnection->prepare("select * from subjects where subject_title=?");
            $SubjectsQuery->execute(array($title));
            $NumberOfSubject = $SubjectsQuery->fetch(PDO::FETCH_ASSOC);
            $Subjects = $SubjectsQuery->rowCount();

            if ($Subjects) {
                echo '<div class="warning-message-container">
                <div class="warning-message-content"><i class="fas fa-exclamation"></i>Lütfen farklı bir başlık giriniz.</div>
              </div>';
            } else {
                $SubjectAdd = $DatabaseConnection->prepare("insert into subjects set 
                subject_title=?,
                subject_explanation=?,
                subject_owner=?,                
                subject_category=?,
                subject_image=?
                
                
");
                $SubjectAccept = $SubjectAdd->execute(array($title, $text, $_SESSION["user"], $category, $image));
                if ($SubjectAccept) {
                    header("location:home.php");
                } else {
                    echo '<div class="warning-message-container">
                <div class="warning-message-content"><i class="fas fa-exclamation"></i>Ders eklerken bir hata oluştu.</div>
              </div>';
                    header("refresh:2 location:home.php");
                }
            }
        }
    } else {
        ?>
        <form action="" method="post">
            <section class="subject-add">
                <div class="subject-add-container">
                    <div class="subject-add-container-content">
                        <div class="subject-add-container-content-title">
                            <input type="text" name="title" placeholder="title...">
                        </div>
                        <div class="subject-add-container-content-image">
                            <input type="text" name="image" placeholder="image source...">
                        </div>
                        <div class="subject-add-container-content-category-list">
                            <select name="category" id="" placeholder="categories">
                                <?php
                                $CategoryQuery = $DatabaseConnection->prepare("select * from categories");
                                $CategoryQuery->execute(array());
                                $NumberOfCategory = $CategoryQuery->fetchAll(PDO::FETCH_ASSOC);
                                //                            $Categories = $CategoryQuery->rowCount();

                                foreach ($NumberOfCategory as $CategoryItem) {
                                    echo '<option value="' . $CategoryItem["category_id"] . '">' . $CategoryItem["category_name"] . '</option>';
                                }

                                ?>
                            </select>
                        </div>
                        <div class="subject-add-container-content-text">
                            <textarea name="text" id="" cols="200" rows="50" placeholder="Text"></textarea>
                        </div>
                        <div class="subject-add-container-content-send-button">
                            <button class="btn" type="submit">Share</button>
                        </div>
                    </div>
                </div>
            </section>
        </form>
        <?php
    }
} else {
    echo '<div class="warning-message-container">
                <div class="warning-message-content"><i class="fas fa-exclamation"></i>Ders ekleyebilmek için üye olmalısınız.</div>
              </div>';
}
