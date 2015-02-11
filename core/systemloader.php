<?php
require_once(dirname(__FILE__) . "/database.php");
require_once(dirname(__FILE__) . "/path.php");
require_once(dirname(__FILE__) . "/security.class.php");
require_once(dirname(__FILE__) . "/TemplateEngine.php");

class System{

    public function apploader(){
    	$this->dbconnection();
        $requesturi = Path::PathParser();
        
        if($GLOBALS['reservedkeywords'][$requesturi["appname"]]["file"] != null){
            if($GLOBALS['reservedkeywords'][$requesturi["appname"]]["loginrequire"]) $this->check_login();
            if($GLOBALS['reservedkeywords'][$requesturi["appname"]]["method"] == "template"){
                echo Template::call_file(dirname(dirname(__FILE__)).'/'.$GLOBALS['reservedkeywords'][$requesturi["appname"]]["file"]);
            }else{
                require(dirname(dirname(__FILE__)).'/'.$GLOBALS['reservedkeywords'][$requesturi["appname"]]["file"]);
            }
        }else{
            $this->check_login();
            require(dirname(dirname(__FILE__))."/app/".$requesturi["appname"]."/load.php");
            AppLoader::method($requesturi["method"]);
        }
    }


    private function dbconnection(){
        global $config;
        $GLOBALS['db'] = new MySQL($config['sql']['dbname'], $config['sql']['username'], $config['sql']['password'], $config['sql']['host']);
    }

    private function check_login(){
        if(!$_SESSION["login"]){
            header("Location: ".Path::AbsolutePathLinkParser().'/login');
            exit();
        }
    }


}