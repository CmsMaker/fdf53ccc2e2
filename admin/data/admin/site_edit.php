<?php
session_start();
if ( isset($_SESSION['admin']) ) {
include "../../../config.php";
include "../../../include/mysql.class.php";
$db = new Mysql($host,$dbuname,$dbpass,$dbname,false);
$db->Database_Connect();

$id = $_POST['id'];
$title = $_POST['name'];
$url = $_POST['url'];

if($title == ""){
	echo "<div class='message-error'>عنون سایت را وارد نمائید.</div>";
}
elseif($url == ""){
	echo "<div class='message-error'>آدرس سایت را وارد نمائید.</div>";
}

elseif($db->sql_getrows("SELECT * FROM `sites` WHERE `id`='".$id."'") > 0){
	$db->sql_query("UPDATE `sites` SET `title`='$title',`url`='$url' WHERE `id`='$id'");
		echo "<div class='message-success'>ویرایش سایت موفقیت آمیز بود</div>";
	} else {
				echo	"<div class='message-error'>سایتی یافت نشد</div>";
	}
}
else {
	echo "درخواست شما نامعتبر می باشد.";	
}

?>