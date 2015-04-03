<?php
require_once(dirname(__FILE__).'/core/database.php');
$schoolname = $GLOBALS['db']->select('setting',array('name'=>'schoolname'));
echo str_replace('<% schoolname %>',$schoolname[0]['value'], file_get_contents('login.html'));