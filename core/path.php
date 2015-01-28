<?php
class Path{

    public static function URLParser(){
        $requesturi = explode('/', $_SERVER['PATH_INFO']);
        array_shift($requesturi);
        return $requesturi;
    }

    public static function PathParser(){
        $requesturi = Path::URLParser();
        return array("appname"=>$requesturi[0],"method"=>$requesturi[1]);
    }

    public static function AbsolutePathLinkParser(){
        $requesturi = Path::URLParser();
        $AbsolutePathLink = "";
        for($i = 0; $i < count($requesturi) ; $i++){
            $AbsolutePathLink .= "../";
        }
        return $AbsolutePathLink;
    }
}