<?php
require_once('AutoLoad.php');
if(isset($_POST["name"])) AutoLoad::Load("Student","import_student",array($_POST["name"],$_POST["id"],$_POST["login_name"],$_POST["academic_year"],$_POST["psd"],$_POST["class_grade"],$_POST["class_name"]));
AutoLoad::Template("New_student");