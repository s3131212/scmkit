<?php 
require_once('AutoLoad.php');
if($_GET["mode"]=="delete"){
    AutoLoad::Load("Announcement","delete_announcement",array($_GET["id"]));
    exit();
}
AutoLoad::Load("Announcement","change_data_table",array($_GET["id"]));