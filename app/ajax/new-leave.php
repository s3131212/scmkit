<?php 
header('Content-Type: application/json; charset=utf-8');
require_once(dirname(dirname(__FILE__)).'/AutoLoad.php');
AutoLoad::Load("Student","new_leave",array($_POST["id"],$_POST["affairs_date"],$_POST["affairs_num"],$_POST["sick_date"],$_POST["sick_num"],$_POST["bereavement_date"],$_POST["bereavement_num"],$_POST["public_date"],$_POST["public_num"],$_POST["truancy_date"],$_POST["truancy_num"]));
echo json_encode(array(array("content"=>'<div class="alert alert-success" style="display:none;">變更完成</div>')));