<?php
$GLOBALS['app'] = array(
    "student"=>array(
        array("title"=>'Home',"url"=>"index.php", "icon" => "fa-home", "short_code" => "index"),
        array("title"=>"Contact Book","url"=>"communication.php", "icon" => "fa-folder-o", "short_code" => "communication"),
        array("title"=>"Announcement","url"=>"announcement.php", "icon" => "fa-bullhorn", "short_code" => "announcement"),
        array("title"=>"Board","url"=>"board.php", "icon" => "fa-folder-o", "short_code" => "board"),
        array("title"=>"Seat","url"=>"seat.php", "icon" => "fa-folder-o", "short_code" => "seat"),
        array("title"=>"Curriculum","url"=>"curriculum.php", "icon" => "fa-calendar-o", "short_code" => "curriculum"),
        array("title"=>"Score","url"=>"score.php", "icon" => "fa-line-chart", "short_code" => "score"),
        array("title"=>"File Share","url"=>"tshare.php", "icon" => "fa-share", "short_code" => "tshare"),
        array("title"=>"Homework","url"=>"homework.php", "icon" => "fa-folder-o", "short_code" => "homework"),
        array("title"=>"User Information","url"=>"user.php", "icon" => "fa-info", "short_code" => "user")
    ),
    "teacher"=>array(
        array("title"=>'Home',"url"=>"index.php", "icon" => "fa-folder-o", "short_code" => "index"),
        array("title"=>"Contact Book","url"=>"communication.php", "icon" => "fa-folder-o", "short_code" => "communication"),
        array("title"=>"Announcement","url"=>"announcement.php", "icon" => "fa-folder-o", "short_code" => "announcement"),
        array("title"=>"Seat","url"=>"seat.php", "icon" => "fa-folder-o", "short_code" => "seat"),
        array("title"=>"Curriculum","url"=>"curriculum.php", "icon" => "fa-folder-o", "short_code" => "curriculum"),
        array("title"=>"Board","url"=>"board-class.php", "icon" => "fa-folder-o", "short_code" => "board"),
        array("title"=>"Score","url"=>"score.php", "icon" => "fa-folder-o", "short_code" => "score"),
        array("title"=>"File Share","url"=>"tshare.php", "icon" => "fa-folder-o", "short_code" => "tshare"),
        array("title"=>"Homework","url"=>"homework.php", "icon" => "fa-folder-o", "short_code" => "homework"),
        array("title"=>"Student","url"=>"student.php", "icon" => "fa-folder-o", "short_code" => "student"),
        array("title"=>"User Information","url"=>"user.php", "icon" => "fa-folder-o", "short_code" => "user")
    ),
    "staff"=>array(
        array("title"=>'Home',"url"=>"index.php", "icon" => "fa-folder-o", "short_code" => "index"),
        array("title"=>"Contact Book","url"=>"communication.php", "icon" => "fa-folder-o", "short_code" => "communication"),
        array("title"=>"Announcement","url"=>"announcement.php", "icon" => "fa-folder-o", "short_code" => "announcement"),
        array("title"=>"Seat","url"=>"seat.php", "icon" => "fa-folder-o", "short_code" => "seat"),
        array("title"=>"Curriculum","url"=>"curriculum.php", "icon" => "fa-folder-o", "short_code" => "curriculum"),
        array("title"=>"Board","url"=>"board-class.php", "icon" => "fa-folder-o", "short_code" => "board"),
        array("title"=>"Score","url"=>"score.php", "icon" => "fa-folder-o", "short_code" => "score"),
        array("title"=>"File Share","url"=>"tshare.php", "icon" => "fa-folder-o", "short_code" => "tshare"),
        array("title"=>"Homework","url"=>"homework.php", "icon" => "fa-folder-o", "short_code" => "homework"),
        array("title"=>"Student","url"=>"student.php", "icon" => "fa-folder-o", "short_code" => "student"),
        array("title"=>"Teacher","url"=>"teacher-list.php", "icon" => "fa-folder-o", "short_code" => "teacher_list"),
        array("title"=>"Staff","url"=>"staff-list.php", "icon" => "fa-folder-o", "short_code" => "staff_list"),
        array("title"=>"Class","url"=>"class.php", "icon" => "fa-folder-o", "short_code" => "class"),
        array("title"=>"System","url"=>"system.php", "icon" => "fa-folder-o", "short_code" => "system"),
        array("title"=>"User Information","url"=>"user.php", "icon" => "fa-folder-o", "short_code" => "user")
    )
);

$GLOBALS['reservedkeywords'] = array(
    "login" => array("file"=>"login.html","method"=>"template","loginrequire"=>false),
    "login_ajax" => array("file"=>"login_ajax.php","method"=>"require","loginrequire"=>false)
);