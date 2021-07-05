<?php //include "memberLogin.php" ?>
<?php session_start(); ?>
<header id="header" class="header">
    <div class="header-container">
        <div class="header-cont-top">
            <div class="header-cont-top-icon">
                <i class="fas fa-book"></i>
            </div>
            <div class="header-cont-top-title">
                <h1>Developer Library</h1>
            </div>
        </div>
        <nav class="header-cont-navbar">
            <ul>
                <li><a href="home.php">HOME</a></li>
                <li><a href="?do=category">CATEGORIES</a></li>
                <li><a href="">ABOUT US</a></li>
            </ul>
        </nav>
        <div class="header-cont-right">
            <div class="header-cont-right-search-button">
                <form action="?do=search" method="post">
                    <input type="text" name="search" placeholder="search..."/>
                    <button type="submit"><i class="fas fa-search"></i></button>
                </form>
            </div>
            <div class="btn-login">

                <button class="btn"><i class="far fa-user"></i><a
                            href="?do=profile&user=<?php echo $_SESSION["user"]; ?>"><?php

                        echo $_SESSION["user"];

                        ?></a></button>
            </div>
            <div class="header-cont-right-exit-button">
                <button><a href="?do=subject_add"><i class="far fa-edit"></i></a></button>
            </div>
            <div class="header-cont-right-exit-button">
                <button><a href="?do=message"><i class="far fa-bell"></i><span>
                            <?php
                            $MessageQuery = $DatabaseConnection->prepare("select * from messages where message_recipient=? and message_read=?");
                            $MessageQuery->execute(array($_SESSION["id"],0));
                            $NumberOfMessage = $MessageQuery->fetchAll(PDO::FETCH_ASSOC);
                            $Messages = $MessageQuery->rowCount();

                            echo $Messages;
                            ?>
                        </span></a></button>
                <span> </span>
            </div>
            <div class="header-cont-right-exit-button">
                <button><a href="?do=exit"><i class="fas fa-sign-out-alt"></i></a></button>
            </div>
        </div>
    </div>
</header>