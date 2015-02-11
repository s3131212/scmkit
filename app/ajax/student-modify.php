<?php 
header('Content-Type: application/json; charset=utf-8');
require_once(dirname(dirname(__FILE__)).'/AutoLoad.php');
if(AutoLoad::Load("Student","update_info",array($_POST["name"],$_POST["login_name"],$_POST["address"],$_POST["phone"],$_POST["personalid"],$_POST["class_grade"],$_POST["class_name"],$_POST["academic_year"],$_POST["firstleveldemerit"],$_POST["secondleveldemerit"],$_POST["warning"],$_POST["firstcredit"],$_POST["secondcredit"],$_POST["reward"],$_POST["id"]))){
    echo json_encode(array(array("content"=>'<div class="alert alert-success" style="display:none;">變更完成</div>')));
}