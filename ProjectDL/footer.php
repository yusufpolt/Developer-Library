<?php include "settings/setting.php"; ?>
<footer id="footer" class="footer">
    <div class="footer-container">
        <div class="footer-container-main">
            <div class="footer-container-main-about-site">
                <div class="footer-container-main-about-site-title">
                    <h2>ABOUT SITE</h2>
                </div>
                <div class="footer-container-main-about-site-content">
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Deleniti quod laudantium facilis illo,
                        doloribus quo fugiat esse architecto modi beatae consequatur, eaque error vero a molestiae
                        inventore! Odio rem eligendi culpa. Sapiente nulla ipsam dicta possimus deserunt quos non! Ea
                        dolorum quam quaerat accusamus commodi.</p>
                </div>
            </div>
            <div class="footer-cotainer-main-categories">
                <div class="footer-cotainer-main-categories-title">
                    <h2>POP CATEGORIES</h2>
                    <span></span>
                </div>
                <div class="footer-cotainer-main-categories-list">
                    <ul>
                        <?php
                        $PopSubjectsQuery = $DatabaseConnection->prepare("select * from subjects order by subject_hit desc limit 4");
                        $PopSubjectsQuery->execute(array());
                        $NumberOfPopSubject = $PopSubjectsQuery->fetchAll(PDO::FETCH_ASSOC);
                        $PopSubject = $PopSubjectsQuery->rowCount();

                        if ($PopSubject) {
                            foreach ($NumberOfPopSubject as $PopItem) {
                                ?>
                                <li><a
                                            href="?do=more&id=<?php echo $PopItem["subject_id"]; ?>"><?php echo $PopItem["subject_title"]; ?></a>
                                </li>
                                <?php
                            }
                        }
                        ?>
                    </ul>
                </div>
            </div>
            <div class="footer-container-main-quick-links">
                <div class="footer-container-main-quick-links-title">
                    <h2>QUICK LINKS</h2>
                </div>
                <div class="footer-container-main-quick-links-list">
                    <ul>
                        <li><a href="home.php">Home</a></li>
                        <li><a href="?do=category">Categories</a></li>
                        <li><a href="">About Us</a></li>
                    </ul>
                </div>
            </div>
            <div class="footer-container-main-social-links">
                <div class="footer-container-main-social-links-title">
                    <h2>SOCIAL LINKS</h2>
                </div>
                <div class="footer-container-main-social-links-list">
                    <ul>
                        <li><i class="fab fa-facebook"><a href="">Facebook</a></i></li>
                        <li><i class="fab fa-twitter"><a href="">Twitter</a></i></li>
                        <li><i class="fab fa-instagram"><a href="">Instagram</a></i></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="footer-container-border">

        </div>
        <div class="footer-container-copy-right">
            <div class="footer-container-copy-right-icon">
                <i class="far fa-copyright"></i>
            </div>
            <div class="footer-container-copy-right-icon-content">
                <p>Copyright:</p>
            </div>
            <div class="footer-container-copy-right-icon-author">
                <p>Yusuf POLAT</p>
            </div>
        </div>
    </div>
</footer>