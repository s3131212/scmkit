<?php
$GLOBALS["methoddata"] = array(
    "student"=>array(
        "scoreview"=>array("methodname"=>"score_page","parameter"=>array($_SESSION["login_id"],$_SESSION["class"])),
        "scoresheet"=>array("methodname"=>"scoresheet_view","parameter"=>array($_GET["id"]))
    ),
    "teacher"=>array(

    ),
    "staff"=>array(

    )
);