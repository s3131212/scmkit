<?php
require_once(dirname(__FILE__) . "/sql.class.php");

//Enter sql database name
$config['sql']['dbname'] = '';

//Enter database username
$config['sql']['username'] = '';

//Enter database password
$config['sql']['password'] = '';

//Enter sql host
$config['sql']['host'] = '';

$GLOBALS['db'] = new MySQL($config['sql']['dbname'], $config['sql']['username'], $config['sql']['password'], $config['sql']['host']);