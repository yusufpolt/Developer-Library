<?php

if($_SESSION){


    $id = $_GET["id"];

    $MessageQuery = $DatabaseConnection->prepare("delete from messages where message_id=? and message_recipient=?");
    $MessageDelete =  $MessageQuery->execute(array($id,$_SESSION["id"]));
    $Messages =  $MessageQuery->rowCount();

    if($Messages){

        if($MessageDelete){



            header("refresh: 0; url=?do=message");

        }  else {

            echo '<div class="warning-message-container">
                             <div class="warning-message-content"><i class="fas fa-exclamation"></i>Opps mesaj silinirken beklenmeyen bir hata oldu.</div>
                          </div>';

            header("refresh: 2; url=?do=message");

        }

    }else {


        echo '<div class="warning-message-container">
                             <div class="warning-message-content"><i class="fas fa-exclamation"></i>Opps beklenmeyen bir hata oldu.</div>
                          </div>';

        header("refresh: 2; url=?do=message");

    }

}
