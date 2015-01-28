<?php
require_once(dirname(__FILE__) . '/template_data.php');

class Template {
    public static function call_view($file,$array = 0){
        $schoolname = $GLOBALS['db']->select("setting", array("name" => "schoolname"));
        $schoolname = $schoolname[0]["value"];
        $output = file_get_contents(dirname(dirname(__FILE__)).'/app/'.$file["appname"].'/template/'.$_SESSION["permission"].'/'.$file["file"].'.php');
        $output = str_replace("<% schoolname %>", $schoolname, $output);
        $output = str_replace("<% username %>", $_SESSION['login_name'], $output);
        $output = str_replace("<% header %>", Template::header(), $output);
        preg_match("/<%(\s)nav(\s)\|(\s)(\w+)(\s)%>/",$output, $matches);
        $nav = trim($matches[0]);
        $nav = str_replace("<% nav | ", "", $nav);
        $nav = str_replace(" %>", "", $nav);
        $output = preg_replace("/<%(\s)nav(\s)\|(\s)(\w+)(\s)%>/i", Template::navigation($nav) , $output);
        if(is_array($array)){
            foreach ($array as $key => $value) {
                $output = str_replace("<% ".$key." %>", $value, $output);
            }
        }
        $output = preg_replace("/<%(\s)(\w+)(\s)%>/i", "" , $output); //把沒有被宣告的 tag 全部刪除
        return $output;
    }
    public static function call_file($file){
        $schoolname = $GLOBALS['db']->select("setting", array("name" => "schoolname"));
        $schoolname = $schoolname[0]["value"];
        $output = file_get_contents($file);
        $output = str_replace("<% schoolname %>", $schoolname, $output);
        $output = str_replace("<% username %>", $_SESSION['login_name'], $output);
        $output = str_replace("<% header %>", Template::header(), $output);
        return $output;
    }
    private static function navigation($select){
        $nav = $GLOBALS['app'][$_SESSION["permission"]];
        $output = '<aside class="sidebar"><ul class="navigation">';
        foreach ($nav as $value) {
            $append = ($select == trim(strtolower($value["short_code"]))) ? ' class="active"' : '';
            $output.= '<li><a href="'.$value["url"].'" '.$append.'><i class="fa ' . $value['icon'] .'"></i> <span>'.$value["title"].'</span></a></li>';
        }
        $output .= "</ul></aside>";
        return $output;
    }
    private static function header(){
        return '<link rel="stylesheet" href="'.Path::AbsolutePathLinkParser().'stylesheets/style.css"><script src="'.Path::AbsolutePathLinkParser().'javascripts/jquery.min.js"></script><script src="'.Path::AbsolutePathLinkParser().'javascripts/ajax_load.js"></script><script src="'.Path::AbsolutePathLinkParser().'javascripts/basic.js"></script>';
    }
}