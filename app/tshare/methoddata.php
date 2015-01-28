<?php
$GLOBALS["methoddata"] = array(
    "student"=>array(
        "view"=>array("methodname"=>"tshare_list_table","parameter"=>""),
        "download"=>array("methodname"=>"tdownload","parameter"=>array($_GET["id"]))
    ),
    "teacher"=>array(
    	"list"=>array("methodname"=>"tshare_list_table","parameter"=>""),
    	"download"=>array("methodname"=>"tdownload","parameter"=>array($_GET["id"])),
    	"upload"=>array("methodname"=>"upload_form","parameter"=>""),
    	"change"=>array("methodname"=>"share_change_form","parameter"=>array($_GET["id"]))
    ),
    "staff"=>array(

    )
);