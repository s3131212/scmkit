<?php
$GLOBALS['app'] = array(
    "student" => array(
        array("title"=>'Dashboard',"url"=>Path::AbsolutePathLinkParser()."index.php/dashboard/view", "icon" => "fa-home", "short_code" => "index", "loginrequire" => true ),
        array("title"=>"Contact Book","url"=>Path::AbsolutePathLinkParser()."index.php/communication/view", "icon" => "fa-folder-o", "short_code" => "communication", "loginrequire" => true ),
        array("title"=>"Announcement","url"=>Path::AbsolutePathLinkParser()."index.php/announcement/view", "icon" => "fa-bullhorn", "short_code" => "announcement", "loginrequire" => true ),
        array("title"=>"Board","url"=>Path::AbsolutePathLinkParser()."index.php/board/list", "icon" => "fa-folder-o", "short_code" => "board", "loginrequire" => true ),
        array("title"=>"Seat","url"=>Path::AbsolutePathLinkParser()."index.php/seat/view", "icon" => "fa-folder-o", "short_code" => "seat", "loginrequire" => true ),
        array("title"=>"Curriculum","url"=>Path::AbsolutePathLinkParser()."index.php/curriculum/view", "icon" => "fa-calendar-o", "short_code" => "curriculum", "loginrequire" => true ),
        array("title"=>"Score","url"=>Path::AbsolutePathLinkParser()."index.php/score/scoreview", "icon" => "fa-line-chart", "short_code" => "score", "loginrequire" => true ),
        array("title"=>"File Share","url"=>Path::AbsolutePathLinkParser()."index.php/tshare/view", "icon" => "fa-share", "short_code" => "teacher_share", "loginrequire" => true ),
        array("title"=>"Homework","url"=>Path::AbsolutePathLinkParser()."index.php/homework/view", "icon" => "fa-folder-o", "short_code" => "homework", "loginrequire" => true ),
        array("title"=>"User Information","url"=>Path::AbsolutePathLinkParser()."index.php/user/view", "icon" => "fa-info", "short_code" => "user", "loginrequire" => true )
    ),
    "teacher" => array(
        array("title"=>'Dashboard',"url"=>Path::AbsolutePathLinkParser()."index.php/dashboard/view", "icon" => "fa-folder-o", "short_code" => "index", "loginrequire" => true ),
        array("title"=>"Contact Book","url"=>Path::AbsolutePathLinkParser()."index.php/communication/view", "icon" => "fa-folder-o", "short_code" => "communication", "loginrequire" => true ),
        array("title"=>"Announcement","url"=>Path::AbsolutePathLinkParser()."index.php/announcement/view", "icon" => "fa-folder-o", "short_code" => "announcement", "loginrequire" => true ),
        array("title"=>"Seat","url"=>Path::AbsolutePathLinkParser()."index.php/seat/view", "icon" => "fa-folder-o", "short_code" => "seat", "loginrequire" => true ),
        array("title"=>"Curriculum","url"=>Path::AbsolutePathLinkParser()."index.php/curriculum/view", "icon" => "fa-folder-o", "short_code" => "curriculum", "loginrequire" => true ),
        array("title"=>"Board","url"=>Path::AbsolutePathLinkParser()."index.php/board/listclass", "icon" => "fa-folder-o", "short_code" => "board", "loginrequire" => true ),
        array("title"=>"Score","url"=>Path::AbsolutePathLinkParser()."index.php/score/list", "icon" => "fa-folder-o", "short_code" => "score", "loginrequire" => true ),
        array("title"=>"File Share","url"=>Path::AbsolutePathLinkParser()."index.php/teacher_share/list", "icon" => "fa-folder-o", "short_code" => "teacher_share", "loginrequire" => true ),
        array("title"=>"Homework","url"=>Path::AbsolutePathLinkParser()."index.php/homework/list", "icon" => "fa-folder-o", "short_code" => "homework", "loginrequire" => true ),
        array("title"=>"Student","url"=>Path::AbsolutePathLinkParser()."index.php/student/listclass", "icon" => "fa-folder-o", "short_code" => "student", "loginrequire" => true ),
        array("title"=>"User Information","url"=>Path::AbsolutePathLinkParser()."index.php/user/view", "icon" => "fa-folder-o", "short_code" => "user", "loginrequire" => true )
    ),
    "staff" => array(
        array("title"=>'Dashboard',"url"=>Path::AbsolutePathLinkParser()."index.php/dashboard/view", "icon" => "fa-folder-o", "short_code" => "index", "loginrequire" => true ),
        array("title"=>"Contact Book","url"=>Path::AbsolutePathLinkParser()."index.php/communication", "icon" => "fa-folder-o", "short_code" => "communication", "loginrequire" => true ),
        array("title"=>"Announcement","url"=>Path::AbsolutePathLinkParser()."index.php/announcement", "icon" => "fa-folder-o", "short_code" => "announcement", "loginrequire" => true ),
        array("title"=>"Seat","url"=>Path::AbsolutePathLinkParser()."index.php/seat", "icon" => "fa-folder-o", "short_code" => "seat", "loginrequire" => true ),
        array("title"=>"Curriculum","url"=>Path::AbsolutePathLinkParser()."index.php/curriculum", "icon" => "fa-folder-o", "short_code" => "curriculum", "loginrequire" => true ),
        array("title"=>"Board","url"=>Path::AbsolutePathLinkParser()."index.php/board_class", "icon" => "fa-folder-o", "short_code" => "board", "loginrequire" => true ),
        array("title"=>"Score","url"=>Path::AbsolutePathLinkParser()."index.php/score", "icon" => "fa-folder-o", "short_code" => "score", "loginrequire" => true ),
        array("title"=>"File Share","url"=>Path::AbsolutePathLinkParser()."index.php/teacher_share", "icon" => "fa-folder-o", "short_code" => "tshare", "loginrequire" => true ),
        array("title"=>"Homework","url"=>Path::AbsolutePathLinkParser()."index.php/homework", "icon" => "fa-folder-o", "short_code" => "homework", "loginrequire" => true ),
        array("title"=>"Student","url"=>Path::AbsolutePathLinkParser()."index.php/student", "icon" => "fa-folder-o", "short_code" => "student", "loginrequire" => true ),
        array("title"=>"Teacher","url"=>Path::AbsolutePathLinkParser()."index.php/teacher_list", "icon" => "fa-folder-o", "short_code" => "teacher_list", "loginrequire" => true ),
        array("title"=>"Staff","url"=>Path::AbsolutePathLinkParser()."index.php/staff_list", "icon" => "fa-folder-o", "short_code" => "staff_list", "loginrequire" => true ),
        array("title"=>"Class","url"=>Path::AbsolutePathLinkParser()."index.php/class", "icon" => "fa-folder-o", "short_code" => "class", "loginrequire" => true ),
        array("title"=>"System","url"=>Path::AbsolutePathLinkParser()."index.php/system", "icon" => "fa-folder-o", "short_code" => "system", "loginrequire" => true ),
        array("title"=>"User Information","url"=>Path::AbsolutePathLinkParser()."index.php/user", "icon" => "fa-folder-o", "short_code" => "user", "loginrequire" => true )
    )
);

$GLOBALS['reservedkeywords'] = array(
    "login" => array("file"=>"login.html","method"=>"template","loginrequire"=>false),
    "login_ajax" => array("file"=>"login_ajax.php","method"=>"require","loginrequire"=>false)
);