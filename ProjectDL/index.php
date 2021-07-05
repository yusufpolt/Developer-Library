<?php
include "settings/setting.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <!-- CSS Style -->
    <link rel="stylesheet" href="./css/home.css">

    <title>Developer Library</title>
</head>
<?php
if ($_SESSION) {
    header("location:home.php");

} else {
    ?>
<body>

<!-- HEADER START -->
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
<!--        <nav class="header-cont-navbar">-->
<!--            <ul>-->
<!--                <li><a href="">HOME</a></li>-->
<!--                <li><a href="">COURSES</a></li>-->
<!--                <li><a href="">TEACHERS</a></li>-->
<!--            </ul>-->
<!--        </nav>-->
        <div class="header-cont-right">
            <div class="btn-login">
                <button class="btn"><a href="login.php">Login</a></button>
            </div>
            <div class="btn-singup">
                <button class="btn"><a href="signup.php">Sign-up</a></button>
            </div>
        </div>
    </div>
</header>
<!-- HEADER END -->

<!-- MAIN SECTION -->
<main class="main">
    <div class="main-container">
        <div class="main-cont-left-content">
            <div class="main-cont-left-content-title">
                <h2>Learn and Teach</h2>
            </div>
            <div class="main-cont-left-content-paragraph">
                <p>
                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Natus dicta earum aut laboriosam illum
                    distinctio optio recusandae exercitationem illo soluta. Consequuntur neque ad laborum amet
                    totam. Unde deleniti modi dolorem odio eos commodi minima fuga, facere atque error, voluptates
                    totam praesentium delectus nemo ullam facilis vero quo, cum repellat itaque.
                </p>
            </div>
            <div class="main-cont-left-content-getstarted">
                <button><a href="signup.php">Get Started</a></button>
            </div>
        </div>
        <div class="main-cont-right-content">
            <div class="main-cont-right-content-img">
                <img src="./img/Cheers.png" alt="">
            </div>
        </div>
    </div>
</main>

<!-- EDUCATOR SECTION -->
<section id="educator" class="educator">
    <div class="container">
        <div class="container-educator">
            <div class="container-eduator-top">
                <div class="container-educator-img">
                    <img src="./img/profile.jpg" alt="profile">
                </div>
                <div class="container-educator-name">
                    <h3>John Doe</h3>
                </div>
            </div>
            <div class="container-educator-content">
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore, reiciendis.</p>
            </div>
            <div class="container-educator-buttons">
                <div class="container-educator-buttons-preview">
                    <button>Preview</button>
                </div>
                <div class="container-educator-buttons-follow">
                    <button>Follow</button>
                </div>
            </div>
        </div>
        <div class="container-educator">
            <div class="container-eduator-top">
                <div class="container-educator-img">
                    <img src="./img/profile.jpg" alt="profile">
                </div>
                <div class="container-educator-name">
                    <h3>John Doe</h3>
                </div>
            </div>
            <div class="container-educator-content">
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore, reiciendis.</p>
            </div>
            <div class="container-educator-buttons">
                <div class="container-educator-buttons-preview">
                    <button>Preview</button>
                </div>
                <div class="container-educator-buttons-follow">
                    <button>Follow</button>
                </div>
            </div>
        </div>
        <div class="container-educator">
            <div class="container-eduator-top">
                <div class="container-educator-img">
                    <img src="./img/profile.jpg" alt="profile">
                </div>
                <div class="container-educator-name">
                    <h3>John Doe</h3>
                </div>
            </div>
            <div class="container-educator-content">
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore, reiciendis.</p>
            </div>
            <div class="container-educator-buttons">
                <div class="container-educator-buttons-preview">
                    <button>Preview</button>
                </div>
                <div class="container-educator-buttons-follow">
                    <button>Follow</button>
                </div>
            </div>
        </div>
        <div class="container-educator">
            <div class="container-eduator-top">
                <div class="container-educator-img">
                    <img src="./img/profile.jpg" alt="profile">
                </div>
                <div class="container-educator-name">
                    <h3>John Doe</h3>
                </div>
            </div>
            <div class="container-educator-content">
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore, reiciendis.</p>
            </div>
            <div class="container-educator-buttons">
                <div class="container-educator-buttons-preview">
                    <button>Preview</button>
                </div>
                <div class="container-educator-buttons-follow">
                    <button>Follow</button>
                </div>
            </div>
        </div>
        <div class="container-educator">
            <div class="container-eduator-top">
                <div class="container-educator-img">
                    <img src="./img/profile.jpg" alt="profile">
                </div>
                <div class="container-educator-name">
                    <h3>John Doe</h3>
                </div>
            </div>
            <div class="container-educator-content">
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore, reiciendis.</p>
            </div>
            <div class="container-educator-buttons">
                <div class="container-educator-buttons-preview">
                    <button>Preview</button>
                </div>
                <div class="container-educator-buttons-follow">
                    <button>Follow</button>
                </div>
            </div>
        </div>
        <div class="container-educator">
            <div class="container-eduator-top">
                <div class="container-educator-img">
                    <img src="./img/profile.jpg" alt="profile">
                </div>
                <div class="container-educator-name">
                    <h3>John Doe</h3>
                </div>
            </div>
            <div class="container-educator-content">
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore, reiciendis.</p>
            </div>
            <div class="container-educator-buttons">
                <div class="container-educator-buttons-preview">
                    <button>Preview</button>
                </div>
                <div class="container-educator-buttons-follow">
                    <button>Follow</button>
                </div>
            </div>
        </div>

    </div>
</section>

<!-- FOOTER -->
<?php include 'footer.php'; ?>


</body>

</html>
    <?php
}
?>
