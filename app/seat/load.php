<?php
require_once(dirname(__FILE__).'/methoddata.php');
class AppLoader{
    
    public static function method($method){
        require_once(dirname(__FILE__) . '/model/'.$_SESSION["permission"].'.model.php');
        require_once(dirname(__FILE__) . '/controller/'.$_SESSION["permission"].'.controller.php');
        require_once(dirname(__FILE__) . '/view/'.$_SESSION["permission"].'.view.php');

        $class = new Seat_Controller;
        if(is_array($GLOBALS["methoddata"][$_SESSION["permission"]][$method]["parameter"])){
            return call_user_func_array(array($class, $GLOBALS["methoddata"][$_SESSION["permission"]][$method]["methodname"]),$GLOBALS["methoddata"][$_SESSION["permission"]][$method]["parameter"]);
        }else{
            return call_user_func(array($class, $GLOBALS["methoddata"][$_SESSION["permission"]][$method]["methodname"]));
        }
    }
}