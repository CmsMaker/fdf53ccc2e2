<?php
session_start();
if ( isset($_SESSION['admin']) ) {
include "../../../config.php";
include "../../../include/mysql.class.php";
$db = new Mysql($host,$dbuname,$dbpass,$dbname,false);
$db->Database_Connect();

$id = $_POST['id'];
$title = $_POST['title'];
$text = $_POST['text'];

if($title == ""){
	echo "<div class='message-error'>عنوان خبر را وارد نمائید.</div>";
}
elseif($text == ""){
	echo "<div class='message-error'>متن خبر را وارد نمائید.</div>";
}
elseif($db->sql_query("UPDATE `news` SET `title`='$title',`text`='$text' WHERE `id`='$id'")){
	
		echo "<div class='message-success'>ویرایش خبر موفقیت آمیز بود</div>";
	} else {
				echo	"<div class='message-error'>خبری با این مشخصات یافت نشد</div>";
	}
}
else {
	echo "درخواست شما نامعتبر می باشد.";	
}

?>