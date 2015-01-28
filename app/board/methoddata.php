<?php
$GLOBALS["methoddata"] = array(
    "student"=>array(
        "list"=>array("methodname"=>"list_board","parameter"=>array($_SESSION["class"])),
        "view"=>array("methodname"=>"view_board","parameter"=>array($_GET["id"])),
        "new"=>array("methodname"=>"new_board","parameter"=>"")
    ),
    "teacher"=>array(
    	"listclass"=>array("methodname"=>"list_class","parameter"=>""),
    	"list"=>array("methodname"=>"list_board","parameter"=>array($_GET["class"])),
        "view"=>array("methodname"=>"view_board","parameter"=>array($_GET["id"])),
        "new"=>array("methodname"=>"new_board","parameter"=>"")
    ),
    "staff"=>array(

    )
);