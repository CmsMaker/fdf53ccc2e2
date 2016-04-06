<?php
session_start();
if ( isset($_SESSION['admin']) ) {
include "../../../config.php";
include "../../../include/mysql.class.php";
$db = new Mysql($host,$dbuname,$dbpass,$dbname,false);
$db->Database_Connect();



if(isset($_GET['type']) && $_GET['type'] == "sms"){
	
	
	$sms_user = $_POST['sms_user'];
	$sms_pass = $_POST['sms_pass'];
	$sms_number = $_POST['sms_number'];
	
	$db->sql_query("UPDATE `sms_setting` SET `sms_user`='$sms_user',`sms_pass`='$sms_pass',`number`='$sms_number'");
		echo "<div class='message-success'>ثبت اطلاعات پنل پیامک موفقیت آمیز بود</div>";
	} 
	elseif(isset($_GET['type']) && $_GET['type'] == "email"){
	
	
	$email = $_POST['email'];
	$name = $_POST['name'];
	
	$db->sql_query("UPDATE `mail_reg` SET `email`='$email',`name`='$name'");
		echo "<div class='message-success'>ثبت اطلاعات ایمیل موفقیت آمیز بود</div>";
	} else {
				echo	"<div class='message-error'>ثبت اطلاعات با خطا روبرو شد.</div>";
	}

}
?>