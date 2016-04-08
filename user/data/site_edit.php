<?php
session_start();
if ( isset($_SESSION['user']) ) {
include "../../config.php";
include "../../include/mysql.class.php";
$db = new Mysql($host,$dbuname,$dbpass,$dbname,false);
$db->Database_Connect();

	$funcPath = 
		$_SERVER[ 'DOCUMENT_ROOT' ] . DIRECTORY_SEPARATOR . "include" . DIRECTORY_SEPARATOR . "func.php";
	require_once( $funcPath );
	
	$mysqli = getMySqlHandel();

$site_id =  $mysqli->real_escape_string( $_POST['site_id'] );
$title =     $mysqli->real_escape_string( $_POST['title'] );
$url =     $mysqli->real_escape_string( $_POST['url'] );

if($title == ""){
	echo "<div class='message-error'>نام سایت را وارد نمائید.</div>";
}
elseif($url == "" || $url == "http://www."){
	echo "<div class='message-error'>آدرس سایت را وارد نمائید.</div>";
}
elseif($db->sql_getrows("SELECT * FROM `sites` WHERE `id`='".$site_id."'") > 0){
	sendSmsToUser( 5 );
	$db->sql_query("UPDATE `sites` SET `title`='$title',`url`='$url',`status`='0' WHERE `id`='$site_id' AND `username`='".$_SESSION['user']."'");
		echo "<div class='message-success'>سایت ویرایش شد و منتظر تایید مدیریت می باشد.</div>";
	} else {
				echo	"<div class='message-error'>سایتی یافت نشد</div>";
	}
}
else {
	echo "درخواست شما نامعتبر می باشد.";	
}

?>