<?php
require_once(dirname(__FILE__) . '/htmlpurifier/HTMLPurifier.auto.php');
class Security{
	public static function xss_filter($content,$KeepSafeTag = false){
        if($KeepSafeTag){
            $purifier = new HTMLPurifier();
            $cleanContent = $purifier->purify($content);
            return $cleanContent;
        }else{
            return htmlspecialchars($content);
        }
    }
}