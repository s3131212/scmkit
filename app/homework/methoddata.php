<?php
$GLOBALS["methoddata"] = array(
    "student"=>array(
        "list"=>array("methodname"=>"homework_list","parameter"=>""),
        "view"=>array("methodname"=>"homework_view","parameter"=>array($_GET["id"])),
        "download"=>array("methodname"=>"hdownload","parameter"=>array($_GET["id"])),
        "upload"=>array("methodname"=>"upload_form","parameter"=>array($_GET["id"])),
        "uploadfile"=>array("methodname"=>"upload_file","parameter"=>array($_FILES,$_GET["id"]))
    ),
    "teacher"=>array(
        "list"=>array("methodname"=>"homework_list","parameter"=>""),
        "view"=>array("methodname"=>"homework_view","parameter"=>array($_GET["id"])),
        "download"=>array("methodname"=>"hdownload","parameter"=>array($_GET["id"])),
        "modify"=>array("methodname"=>"modify_homework_form","parameter"=>array($_GET["id"])),
        "new"=>array("methodname"=>"new_homework_form","parameter"=>"")
    ),
    "staff"=>array(

    )
);