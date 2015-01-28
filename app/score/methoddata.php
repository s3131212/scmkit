<?php
$GLOBALS["methoddata"] = array(
    "student"=>array(
        "scoreview"=>array("methodname"=>"score_page","parameter"=>array($_SESSION["login_id"],$_SESSION["class"])),
        "scoresheet"=>array("methodname"=>"scoresheet_view","parameter"=>array($_GET["id"]))
    ),
    "teacher"=>array(
    	"list"=>array("methodname"=>"score_page","parameter"=>""),
    	"scoreview"=>array("methodname"=>"view_score","parameter"=>array($_GET["id"])),
    	"scoremodify"=>array("methodname"=>"update_score_table","parameter"=>array($_GET["test"],$_GET["id"])),
    	"score_modify_ajax"=>array("methodname"=>"update_score","parameter"=>array($_POST["test"],$_POST["id"],$_POST["score"])),
    	"scoresheetview"=>array("methodname"=>"scoresheet_view","parameter"=>array($_GET["id"])),
    	"scoresheetmodify"=>array("methodname"=>"scoresheet_form","parameter"=>array($_GET["id"]))
    ),
    "staff"=>array(

    )
);