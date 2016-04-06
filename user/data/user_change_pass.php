<?php
session_start();
include "../../config.php";
include "../../include/mysql.class.php";
$db = new Mysql($host,$dbuname,$dbpass,$dbname,false);
$db->Database_Connect();

$pass = md5($_POST['old_password']);
$new_pass = md5($_POST['new_password']);
$try_pass = md5($_POST['try_password']);

$db->sql_query("SELECT * FROM `user` WHERE `username`='".$_SESSION['user']."'");
$fetch = $db->sql_fetcharray();

if(!($pass == $fetch['password'])) {
	echo "<div class='message-error'>کلمه عبور فعلی اشتباه می باشد</div>";
} elseif($_POST['new_password'] == "") {
	echo "<div class='message-error'>کلمه عبور جدید وارد نشده است</div>";
} elseif($_POST['try_password'] == "") {
	echo "<div class='message-error'>تکرار کلمه عبور جدید وارد نشده است</div>";
} elseif(!($new_pass == $try_pass)) {
	echo "<div class='message-error'>کلمه عبور جدید با تکرار کلمه عبور جدید برابر نیست</div>";
} else {
	if($db->sql_query("UPDATE `user` SET password='$new_pass' WHERE `username`='".$_SESSION['user']."'")) {
		echo "<div class='message-success'>کلمه عبور جدید با موفقیت تغییر یافت</div>";
	}
}
?>