<?php
require_once('AutoLoad.php');
if(isset($_FILES["file"])&&$_FILES["file"]["error"]<1) AutoLoad::Load("Teacher","import_teacher",array($_FILES["file"]));
AutoLoad::Template("Import_teacher");