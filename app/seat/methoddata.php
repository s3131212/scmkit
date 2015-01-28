<?php
$GLOBALS["methoddata"] = array(
    "student"=>array(
        "view"=>array("methodname"=>"list_table","parameter"=>"")
    ),
    "teacher"=>array(
    	"view"=>array("methodname"=>"ger_seat","parameter"=>""),
    	"modify"=>array("methodname"=>"list_modify_table","parameter"=>array($_GET["id"])),
    	"ajax_get_name"=>array("methodname"=>"get_name_json","parameter"=>array($_POST["num"],$_POST["class"]))
    ),
    "staff"=>array(

    )
);