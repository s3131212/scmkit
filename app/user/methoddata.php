<?php
$GLOBALS["methoddata"] = array(
    "student"=>array(
        "view"=>array("methodname"=>"get_data","parameter"=>array($_SESSION["login_id"]))
    ),
    "teacher"=>array(
    	"view"=>array("methodname"=>"get_data","parameter"=>array($_SESSION["login_id"])),
    	"changepsd"=>array("methodname"=>"set_pass","parameter"=>array($_POST["psd"],$_POST["psd2"],$_POST["id"]))
    ),
    "staff"=>array(

    )
);