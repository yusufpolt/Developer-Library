<?php
$CategoryQuery = $DatabaseConnection->prepare("select * from categories");
$CategoryQuery->execute(array());
$NumberOfCategory = $CategoryQuery->fetchAll(PDO::FETCH_ASSOC);
$Categories = $CategoryQuery->rowCount();


if ($Categories) {
    ?>
    <section class="categories">
        <div class="categories-container">
            <?php
            foreach ($NumberOfCategory as $CategoryItem) {
                ?>

                <div class="categories-container-content">
                    <div class="categories-container-content-image">
<!--                         <img src="--><?php //echo $CategoryItem["category_image"] ?><!--" alt="resim">-->
                        <?php  echo '<a href="?do=categories&id='.$CategoryItem["category_id"].'"><img src="'.$CategoryItem["category_image"].'" alt="resim"></a>' ?>
<!--                        --><?php // echo '<a href="?do=categories&id='.$CategoryItem["category_id"].'">'.$CategoryItem["category_name"].'</a>' ?>
                    </div>
                    <div class="categories-container-content-description">
                        <?php echo $CategoryItem["category_content"] ?>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
    </section>
    <?php
} else {
    echo '<div class="error">Hiç kategori yok</div>';
}

?>
<!--<section class="categories">-->
<!--    <div class="categories-container">-->
<!--        <div class="categories-container-content">-->
<!--            <div class="categories-container-content-image">-->
<!--                <img src="./img/php.png" alt="">-->
<!--            </div>-->
<!--            <div class="categories-container-content-description">-->
<!--                Lorem, ipsum dolor sit amet consectetur adipisicing elit. Explicabo, laboriosam.-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</section>-->