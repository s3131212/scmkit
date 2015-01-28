<?php
if(!session_id()) session_start();
require_once(dirname(dirname(dirname(__FILE__))) . '/core/database.php');
require_once(dirname(dirname(dirname(__FILE__))) . '/core/htmlpurifier/HTMLPurifier.auto.php');
$GLOBALS['schoolname'] = $GLOBALS['db']->select("setting", array("name" => "schoolname"));
$GLOBALS['schoolname'] = $GLOBALS['schoolname'][0]["value"];
class View {
    public static function call_view($name,$array = 0){
        $output = file_get_contents(dirname(dirname(__FILE__)) . '/template/'.$name.'.php');
        $output = str_replace("<% schoolname %>", $GLOBALS['schoolname'], $output);
        $output = str_replace("<% username %>", $_SESSION['login_name'], $output);
        preg_match("/<%(\s)nav(\s)\|(\s)(\w+)(\s)%>/",$output, $matches);
        $nav = trim($matches[0]);
        $nav = str_replace("<% nav | ", "", $nav);
        $nav = str_replace(" %>", "", $nav);
        $output = preg_replace("/<%(\s)nav(\s)\|(\s)(\w+)(\s)%>/i", View::navigation($nav) , $output);
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
        $nav = array(
            array("title"=>'Home',"url"=>"index.php", "icon" => "fa-folder-o", "short_code" => "index"),
            array("title"=>"Contact Book","url"=>"communication.php", "icon" => "fa-folder-o", "short_code" => "communication"),
            array("title"=>"Announcement","url"=>"announcement.php", "icon" => "fa-folder-o", "short_code" => "announcement"),
            array("title"=>"Seat","url"=>"seat.php", "icon" => "fa-folder-o", "short_code" => "seat"),
            array("title"=>"Curriculum","url"=>"curriculum.php", "icon" => "fa-folder-o", "short_code" => "curriculum"),
            array("title"=>"Board","url"=>"board_class.php", "icon" => "fa-folder-o", "short_code" => "board"),
            array("title"=>"Score","url"=>"score.php", "icon" => "fa-folder-o", "short_code" => "score"),
            array("title"=>"File Share","url"=>"teacher_share.php", "icon" => "fa-folder-o", "short_code" => "tshare"),
            array("title"=>"Homework","url"=>"homework.php", "icon" => "fa-folder-o", "short_code" => "homework"),
            array("title"=>"Student","url"=>"student.php", "icon" => "fa-folder-o", "short_code" => "student"),
            array("title"=>"Teacher","url"=>"teacher_list.php", "icon" => "fa-folder-o", "short_code" => "teacher_list"),
            array("title"=>"Staff","url"=>"staff_list.php", "icon" => "fa-folder-o", "short_code" => "staff_list"),
            array("title"=>"Class","url"=>"class.php", "icon" => "fa-folder-o", "short_code" => "class"),
            array("title"=>"System","url"=>"system.php", "icon" => "fa-folder-o", "short_code" => "system"),
            array("title"=>"User Information","url"=>"user.php", "icon" => "fa-folder-o", "short_code" => "user")
        );
        $output = '<aside class="sidebar"><ul class="navigation">';
        foreach ($nav as $value) {
            $append = ($select == $value["short_code"]) ? ' class="active"' : '';
            $output.= '<li><a href="'.$value["url"].'" '.$append.' ><i class="fa ' . $value["icon"].'"></i> <span>'.$value["title"].'</span></a></li>';
        }
        $output .= "</ul></aside>";
        return $output;
    }
}