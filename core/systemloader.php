<?php
require_once(dirname(__FILE__) . "/database.php");
require_once(dirname(__FILE__) . "/path.php");
require_once(dirname(__FILE__) . "/TemplateEngine.php");

class System{

    public function apploader(){
        $this->dbconnection();
        $requesturi = Path::PathParser();
        require(dirname(dirname(__FILE__))."/app/".$requesturi["appname"]."/load.php");
        AppLoader::method($requesturi["method"]);
    }


    private function dbconnection(){
        global $config;
        $GLOBALS['db'] = new MySQL($config['sql']['dbname'], $config['sql']['username'], $config['sql']['password'], $config['sql']['host']);
    }


}