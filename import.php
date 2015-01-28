<?php
foreach(scandir(dirname(__FILE__)."/teacher/controller") as $value ){
	if($value != ".." && $value != "." && preg_match_all("/[\s\S].controller.php/im", $value)){
		$appname = str_replace(".controller.php", "", $value);
		echo "now moving app:" . $appname . "<br />";

		if(!file_exists(dirname(__FILE__)."/app/".$appname)){
			mkdir(dirname(__FILE__)."/app/".$appname);
			mkdir(dirname(__FILE__)."/app/".$appname."/controller");
			mkdir(dirname(__FILE__)."/app/".$appname."/model");
			mkdir(dirname(__FILE__)."/app/".$appname."/view");
			mkdir(dirname(__FILE__)."/app/".$appname."/template");
			echo "directory ".$appname." not found,creating one now <br />";
		}else{
			echo "directory ".$appname." found. <br />";
		}

		$controller = file_get_contents(dirname(__FILE__)."/teacher/controller/".$value);
		$controller = str_replace("View::", ucfirst($appname)."_View::", $controller);
		if(file_put_contents(dirname(__FILE__)."/app/".$appname."/controller/teacher.controller.php", $controller) !== FALSE){
			echo "controller moving success. <br />";
		}else{
			echo "controller moving fail :( <br />";
		}

		if(file_put_contents(dirname(__FILE__)."/app/".$appname."/model/teacher.model.php", file_get_contents(dirname(__FILE__)."/teacher/model/".$appname.".model.php")) !== FALSE){
			echo "model moving success. <br />";
		}else{
			echo "model moving fail :( <br />";
		}

		$view = file_get_contents(dirname(__FILE__)."/teacher/controller/".$value);
		$view = str_replace(ucfirst($appname)."_Controller", ucfirst($appname)."_View", $view);

		if(file_put_contents(dirname(__FILE__)."/app/".$appname."/view/teacher.view.php", $view ) !== FALSE){
			echo "view moving success. <br />";
		}else{
			echo "view moving fail :( <br />";
		}
		echo "<br /><hr /><br />";
	}
}
print_r(scandir(dirname(__FILE__)."/teacher/controller"));