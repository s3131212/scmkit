<?php
if(!session_id()) session_start();
require_once(dirname(dirname(__FILE__)).'/core/database.php');
require_once(dirname(dirname(__FILE__)).'/core/function.php');
require_once(dirname(dirname(__FILE__)).'/core/security.class.php');
require_once(dirname(dirname(__FILE__)).'/core/TemplateEngine.php');

if(!$_SESSION['login']){
    header("Location: ../login.php");
}

class AutoLoad{
    public static function Load($class_name,$method,$parameters = 0){
        require_once(dirname(__FILE__) . '/model/'.strtolower($class_name).'.model.php');
        require_once(dirname(__FILE__) . '/controller/'.strtolower($class_name).'.controller.php');
        $class_call = $class_name."_Controller";
        $class = new $class_call;
        if(is_array($parameters)){
            return call_user_func_array(array($class, $method),$parameters);
        }else{
            return call_user_func(array($class, $method));
        }
    }
    public static function Template($name){
        echo Template::call_view($name);
    }
}