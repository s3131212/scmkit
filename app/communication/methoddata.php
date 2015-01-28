<?php
$GLOBALS["methoddata"] = array(
    "student"=>array(
        "view"=>array("methodname"=>"list_content","parameter"=>array($_GET["date"])),
        "load"=>array("methodname"=>"get_content_json","parameter"=>array($_POST["date"]))
    ),
    "teacher"=>array(

    ),
    "staff"=>array(

    )
);