<?php
session_start();
if ( isset($_SESSION['admin']) ) {
include "../../../config.php";
include "../../../include/mysql.class.php";
$db = new Mysql($host,$dbuname,$dbpass,$dbname,false);
$db->Database_Connect();

$id = $_POST['id'];
$name = $_POST['name'];
$username = $_POST['username'];
$mobile = $_POST['mobile'];
$email = $_POST['email'];

if($name == ""){
	echo "<div class='message-error'>نام و نام خانوادگی را وارد نمائید.</div>";
}
elseif($mobile == ""){
	echo "<div class='message-error'>شماره موبایل را وارد نمائید.</div>";
}
elseif($email == ""){
	echo "<div class='message-error'>آدرس ایمیل را وارد نمائید.</div>";
}
elseif($db->sql_getrows("SELECT * FROM `user` WHERE `id`='".$id."'") > 0){
	$db->sql_query("UPDATE `user` SET `name`='$name',`username`='$username',`mobile`='$mobile',`email`='$email' WHERE `id`='$id'");
		echo "<div class='message-success'>ویرایش کاربر موفقیت آمیز بود</div>";
	} else {
				echo	"<div class='message-error'>کاربری یافت نشد</div>";
	}
}
else {
	echo "درخواست شما نامعتبر می باشد.";	
}

?>