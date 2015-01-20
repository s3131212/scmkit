<?php
require_once(dirname(__FILE__) . '/htmlpurifier/HTMLPurifier.auto.php');
$GLOBALS['nav'] = array(
    "student" => array(
        array("title"=>'Home',"url"=>Path::AbsolutePathLinkParser()."index.php/"."index", "icon" => "fa-home", "short_code" => "index"),
        array("title"=>"Contact Book","url"=>Path::AbsolutePathLinkParser()."index.php/"."communication/view", "icon" => "fa-folder-o", "short_code" => "communication"),
        array("title"=>"Announcement","url"=>Path::AbsolutePathLinkParser()."index.php/announcement/view", "icon" => "fa-bullhorn", "short_code" => "announcement"),
        array("title"=>"Board","url"=>Path::AbsolutePathLinkParser()."index.php/board/list", "icon" => "fa-folder-o", "short_code" => "board"),
        array("title"=>"Seat","url"=>Path::AbsolutePathLinkParser()."index.php/seat/view", "icon" => "fa-folder-o", "short_code" => "seat"),
        array("title"=>"Curriculum","url"=>Path::AbsolutePathLinkParser()."index.php/curriculum/view", "icon" => "fa-calendar-o", "short_code" => "curriculum"),
        array("title"=>"Score","url"=>Path::AbsolutePathLinkParser()."index.php/score/scoreview", "icon" => "fa-line-chart", "short_code" => "score"),
        array("title"=>"File Share","url"=>Path::AbsolutePathLinkParser()."index.php/tshare/view", "icon" => "fa-share", "short_code" => "teacher_share"),
        array("title"=>"Homework","url"=>Path::AbsolutePathLinkParser()."index.php/homework/view", "icon" => "fa-folder-o", "short_code" => "homework"),
        array("title"=>"User Information","url"=>Path::AbsolutePathLinkParser()."index.php/user/view", "icon" => "fa-info", "short_code" => "user")
    ),
    "teacher" => array(
        array("title"=>'Home',"url"=>Path::AbsolutePathLinkParser()."index.php/index", "icon" => "fa-folder-o", "short_code" => "index"),
        array("title"=>"Contact Book","url"=>Path::AbsolutePathLinkParser()."index.php/communication", "icon" => "fa-folder-o", "short_code" => "communication"),
        array("title"=>"Announcement","url"=>Path::AbsolutePathLinkParser()."index.php/announcement", "icon" => "fa-folder-o", "short_code" => "announcement"),
        array("title"=>"Seat","url"=>Path::AbsolutePathLinkParser()."index.php/seat", "icon" => "fa-folder-o", "short_code" => "seat"),
        array("title"=>"Curriculum","url"=>Path::AbsolutePathLinkParser()."index.php/curriculum", "icon" => "fa-folder-o", "short_code" => "curriculum"),
        array("title"=>"Board","url"=>Path::AbsolutePathLinkParser()."index.php/board_class", "icon" => "fa-folder-o", "short_code" => "board"),
        array("title"=>"Score","url"=>Path::AbsolutePathLinkParser()."index.php/score", "icon" => "fa-folder-o", "short_code" => "score"),
        array("title"=>"File Share","url"=>Path::AbsolutePathLinkParser()."index.php/teacher_share", "icon" => "fa-folder-o", "short_code" => "teacher_share"),
        array("title"=>"Homework","url"=>Path::AbsolutePathLinkParser()."index.php/homework", "icon" => "fa-folder-o", "short_code" => "homework"),
        array("title"=>"Student","url"=>Path::AbsolutePathLinkParser()."index.php/student", "icon" => "fa-folder-o", "short_code" => "student"),
        array("title"=>"User Information","url"=>Path::AbsolutePathLinkParser()."index.php/user", "icon" => "fa-folder-o", "short_code" => "user")
    ),
    "staff" => array(
        array("title"=>'Home',"url"=>Path::AbsolutePathLinkParser()."index.php/index", "icon" => "fa-folder-o", "short_code" => "index"),
        array("title"=>"Contact Book","url"=>Path::AbsolutePathLinkParser()."index.php/communication", "icon" => "fa-folder-o", "short_code" => "communication"),
        array("title"=>"Announcement","url"=>Path::AbsolutePathLinkParser()."index.php/announcement", "icon" => "fa-folder-o", "short_code" => "announcement"),
        array("title"=>"Seat","url"=>Path::AbsolutePathLinkParser()."index.php/seat", "icon" => "fa-folder-o", "short_code" => "seat"),
        array("title"=>"Curriculum","url"=>Path::AbsolutePathLinkParser()."index.php/curriculum", "icon" => "fa-folder-o", "short_code" => "curriculum"),
        array("title"=>"Board","url"=>Path::AbsolutePathLinkParser()."index.php/board_class", "icon" => "fa-folder-o", "short_code" => "board"),
        array("title"=>"Score","url"=>Path::AbsolutePathLinkParser()."index.php/score", "icon" => "fa-folder-o", "short_code" => "score"),
        array("title"=>"File Share","url"=>Path::AbsolutePathLinkParser()."index.php/teacher_share", "icon" => "fa-folder-o", "short_code" => "tshare"),
        array("title"=>"Homework","url"=>Path::AbsolutePathLinkParser()."index.php/homework", "icon" => "fa-folder-o", "short_code" => "homework"),
        array("title"=>"Student","url"=>Path::AbsolutePathLinkParser()."index.php/student", "icon" => "fa-folder-o", "short_code" => "student"),
        array("title"=>"Teacher","url"=>Path::AbsolutePathLinkParser()."index.php/teacher_list", "icon" => "fa-folder-o", "short_code" => "teacher_list"),
        array("title"=>"Staff","url"=>Path::AbsolutePathLinkParser()."index.php/staff_list", "icon" => "fa-folder-o", "short_code" => "staff_list"),
        array("title"=>"Class","url"=>Path::AbsolutePathLinkParser()."index.php/class", "icon" => "fa-folder-o", "short_code" => "class"),
        array("title"=>"System","url"=>Path::AbsolutePathLinkParser()."index.php/system", "icon" => "fa-folder-o", "short_code" => "system"),
        array("title"=>"User Information","url"=>Path::AbsolutePathLinkParser()."index.php/user", "icon" => "fa-folder-o", "short_code" => "user")
    )
);

class Template {
    public static function call_view($file,$array = 0){
        $schoolname = $GLOBALS['db']->select("setting", array("name" => "schoolname"));
        $schoolname = $schoolname[0]["value"];
        $output = file_get_contents(dirname(dirname(__FILE__)).'/app/'.$file["appname"].'/template/student/'.$file["file"].'.php');
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
    public static function xss_filter($content,$KeepSafeTag = false){
        if($KeepSafeTag){
            $purifier = new HTMLPurifier();
            $cleanContent = $purifier->purify($content);
            return $cleanContent;
        }else{
            return htmlspecialchars($content);
        }
    }
    private static function navigation($select){
        $nav = $GLOBALS['nav'][$_SESSION["permission"]];
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