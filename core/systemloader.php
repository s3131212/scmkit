<?php
require_once(dirname(__FILE__) . "/database.php");
require_once(dirname(__FILE__) . "/path.php");
require_once(dirname(__FILE__) . "/TemplateEngine.php");

class System{

    public function apploader(){
        if(!$_SESSION["login"]){
            header("Location: ".Path::AbsolutePathLinkParser().'/user/login');
        }
        $this->dbconnection();
        $requesturi = Path::PathParser();
        if($GLOBALS['reservedkeywords'][$requesturi["appname"]]["file"] != null){
            if($GLOBALS['reservedkeywords'][$requesturi["appname"]]["method"] == "template"){
                echo Template::call_file(dirname(dirname(__FILE__)).'/'.$GLOBALS['reservedkeywords'][$requesturi["appname"]]["file"]);
            }else{
                require(dirname(dirname(__FILE__)).'/'.$GLOBALS['reservedkeywords'][$requesturi["appname"]]["file"]);
            }
        }else{
            require(dirname(dirname(__FILE__))."/app/".$requesturi["appname"]."/load.php");
            AppLoader::method($requesturi["method"]);
        }
    }


    private function dbconnection(){
        global $config;
        $GLOBALS['db'] = new MySQL($config['sql']['dbname'], $config['sql']['username'], $config['sql']['password'], $config['sql']['host']);
    }


}