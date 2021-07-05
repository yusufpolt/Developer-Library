<?php define("index", true); ?>
<?php include("./settings/setting.php"); ?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <!-- CSS Style -->
    <link rel="stylesheet" href="./css/home.css">

    <title>Home</title>
</head>
<!--HEADER-->
<?php include "header.php"; ?>
<!--HEADER-->

<!--MAIN SECTION-->
<?php
$do = @$_GET["do"];

switch ($do) {

    case "categories":
        include("list_of_category.php");
        break;

    case "search":
        include("search.php");
        break;

    case "subject_add":
        include("subject_add.php");
        break;

    case "profile":
        include("profile.php");
        break;

    case "profile_edit":
        include("profile_edit.php");
        break;

    case "message":
        include("message.php");
        break;

    case "message_read":
        include("message_read.php");
        break;

    case "message_send":
        include("message_send.php");
        break;

    case "message_delete":
        include("message_delete.php");
        break;

    case "exit":
        session_destroy();
        header("refresh:0; url=index.php");
        break;

    case "category":
        include("categories.php");
        break;

    case "more":
        include("more.php");
        break;

    default :
        include("subjects.php");
        break;
}
?>
<!--MAIN SECTION-->

<!--FOOTER-->
<?php include "footer.php"; ?>
<!--FOOTER-->

