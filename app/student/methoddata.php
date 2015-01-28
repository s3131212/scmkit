<?php
$GLOBALS["methoddata"] = array(
    "student"=>array(
    ),
    "teacher"=>array(
    	"listclass"=>array("methodname"=>"list_class","parameter"=>""),
    	"list"=>array("methodname"=>"list_student","parameter"=>array(100,$_GET["page"],$_GET["class"])),
        "view"=>array("methodname"=>"list_info","parameter"=>array($_GET["id"])),
        "modify"=>array("methodname"=>"modify_info_table","parameter"=>array($_GET["id"])),
        "modify_student_ajax"=>array("methodname"=>"update_info","parameter"=>array($_POST["name"],$_POST["login_name"],$_POST["address"],$_POST["phone"],$_POST["personalid"],$_POST["class_grade"],$_POST["class_name"],$_POST["academic_year"],$_POST["firstleveldemerit"],$_POST["secondleveldemerit"],$_POST["warning"],$_POST["firstcredit"],$_POST["secondcredit"],$_POST["reward"],$_POST["id"])),
        "new_leave"=>array("methodname"=>"new_leave","parameter"=>array($_POST["id"],$_POST["affairs_date"],$_POST["affairs_num"],$_POST["sick_date"],$_POST["sick_num"],$_POST["bereavement_date"],$_POST["bereavement_num"],$_POST["public_date"],$_POST["public_num"],$_POST["truancy_date"],$_POST["truancy_num"]))
    ),
    "staff"=>array(

    )
);