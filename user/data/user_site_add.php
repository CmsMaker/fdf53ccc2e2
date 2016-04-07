<?php
session_start();
if ( isset($_SESSION['user']) ) {
include "../../config.php";
include "../../include/mysql.class.php";


	# new Code ( SMS )
	
	$funcPath = 
		$_SERVER[ 'DOCUMENT_ROOT' ] . DIRECTORY_SEPARATOR . "include" . DIRECTORY_SEPARATOR . "func.php";
	require_once( $funcPath );
	
	# End


$db = new Mysql($host,$dbuname,$dbpass,$dbname,false);
$db->Database_Connect();

$mysqli = getMySqlHandel();

$site_title =  $mysqli->real_escape_string( $_POST['site_title'] );
$site_url =     $mysqli->real_escape_string( $_POST['site_url']  );
$site_credit =   $mysqli->real_escape_string(  $_POST['site_credit'] );

$db->sql_query("SELECT * FROM `user` WHERE `username`='".$_SESSION['user']."'");
$fetch = $db->sql_fetcharray();

$cost = $site_credit;
if($site_title == "") {
	echo "<div class='message-error'>عنوان سایت را وارد نمائید.</div>";
} elseif($site_url == "http://www.") {
	echo "<div class='message-error'>آدرس سایت را وارد نمائید.</div>";
} elseif($site_credit == "") {
	echo "<div class='message-error'>تعداد بازدید را مشخص نمائید.</div>";
}
elseif(!is_numeric($site_credit)) {
	echo "<div class='message-error'>ساختار بازدید باید عددی باشد.</div>";
}
elseif($cost > $fetch['credit']) {
	echo "<div class='message-error'>تعداد بازدید بیشتر از موجودی شما می باشد.</div>";
}
elseif($site_credit == 0 || $site_credit < 0) {
	echo "<div class='message-error'>تعداد بازدید نامعتبر است.</div>";
} else {
	
	sendSmsToUser( 4 );
	
	$db->sql_query("UPDATE `user` SET `credit`=credit-$cost WHERE `username`='".$_SESSION['user']."'");
	$db->sql_query( " INSERT INTO `sites` (title,url,view,username,status,credit ) VALUES 
('$site_title', '$site_url','0', '".$_SESSION['user']."', '0', '$site_credit')
				"); {
		echo "<div class='message-success'>سایت افزوده شد و منتظر تایید مدیریت می باشد.</div>";
	}
}
}
?>