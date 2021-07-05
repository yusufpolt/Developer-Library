<?php
//!defined("index") ? die("hacking hee!!") : null;
$host = "localhost";
$databaseName = "developerlibrary";
$rootName = "root";
$rootPassword = "";

try {
    $DatabaseConnection = new PDO("mysql:host=$host;dbname=$databaseName;charset=UTF8","$rootName","$rootPassword");
}catch (PDOException $error){
    echo "Database hatası" . $error->getMessage();
}