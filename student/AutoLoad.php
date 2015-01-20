<?php
require_once('require.php');
class AutoLoad{
    public static function Load($class_name,$method,$parameters = 0){
        require_once(dirname(__FILE__) . '/model/'.strtolower($class_name).'.model.php');
        require_once(dirname(__FILE__) . '/controller/'.strtolower($class_name).'.controller.php');
        require_once(dirname(__FILE__) . '/view/view.php');
        $class_call = $class_name."_Controller";
        $class = new $class_call;
        if(is_array($parameters)){
            return call_user_func_array(array($class, $method),$parameters);
        }else{
            return call_user_func(array($class, $method));
        }
    }
    public static function Template($name){
        require_once(dirname(__FILE__) . '/view/view.php');
        echo View::call_view($name);
    }
}