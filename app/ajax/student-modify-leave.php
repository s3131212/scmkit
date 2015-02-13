<?php 
header('Content-Type: application/json; charset=utf-8');
require_once(dirname(dirname(__FILE__)).'/AutoLoad.php');
if(AutoLoad::Load("Student","modify_leave",array($_POST["id"],$_GET["mode"],array("studentid"=>$_POST["studentid"],"id"=>$_POST["id"],"type"=>$_POST["type"],"lessons"=>$_POST["lessons"],"date"=>$_POST["date"],"reason"=>$_POST["reason"])))){
    echo json_encode(array(array("content"=>'<div class="alert alert-success" style="display:none;">變更完成</div>')));
}