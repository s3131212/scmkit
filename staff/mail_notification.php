<?php
if(!session_id()) session_start();
require_once(dirname(dirname(__FILE__)) . '/core/database.php');
require_once (dirname(dirname(__FILE__)).'/core/phpmailer/class.phpmailer.php');
require_once('require.php');
mb_internal_encoding('UTF-8'); 
ignore_user_abort(true);
set_time_limit(0);
$smtp_host = ini_get("SMTP");
$mail_setting=infoget("mail");
$schoolname=infoget("schoolname");
$mail_server=infoget("mail_server");
$mail_auth=infoget("mail_auth");
$mail_user=infoget("mail_user");
$mail_psd=infoget("mail_psd");
$mail_port=infoget("mail_port");

$mail = new PHPMailer();
if($mail_setting[0]["value"]!="true") exit(); 
$mail->isSMTP();
$mail->CharSet = 'UTF-8';
if($mail_server[0]["value"] != null) $mail->Host = $mail_server[0]["value"];
else $mail->Host = ini_get("SMTP");
if($mail_user[0]["value"] != null && $mail_auth == "true"){
	$mail->SMTPAuth = true;
	$mail->Username = $mail_user[0]["value"];
	$mail->Password = $mail_psd[0]["value"];
	$mail->From = $mail_user[0]["value"];
}else{
	$mail->SMTPAuth = false;
	$mail->From = "root@" . $_SERVER['HTTP_HOST'];
}
if($mail_port[0]["value"] != null){
	$mail->Port = $mail_port[0]["value"];
}else{
	$mail->Port = 25;
}
$mail->Subject = $schoolname[0]["value"] . "發佈了一個新公告：" .$_GET["title"];
$mail->Body = $schoolname[0]["value"] . "剛剛發佈了一個新公告，請務必閱讀，避免漏掉任何重要訊息";
foreach($db->select("student") as $d){
	if($d['email']!=null){
		$mail->AddAddress($d["email"],$d["name"]);
		if(!$mail->Send()){
    		echo "Mailer Error: " . $mail->ErrorInfo;
    		exit();//例外終止
   		}
		echo $d["email"];
		sleep(1);//等待1秒，減少伺服器負擔
	}
}
foreach($db->select("teacher") as $d){
	if($d['email']!=null){
		$mail->AddAddress($d["email"],$d["name"]);
		if(!$mail->Send()){
    		echo "Mailer Error: " . $mail->ErrorInfo;
    		exit();//例外終止
   		}
		echo $d["email"];
		sleep(1);//等待1秒，減少伺服器負擔
	}
}
ignore_user_abort(false);