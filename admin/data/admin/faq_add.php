<?php
session_start();
if ( isset($_SESSION['admin']) ) {

include "../../../config.php";
include "../../../include/mysql.class.php";
$db = new Mysql($host,$dbuname,$dbpass,$dbname,false);
$db->Database_Connect();

if(isset($_POST['title'])) {
	$title = $_POST['title'];
	$text = $_POST['text'];
	}

	if ($title == ""){
	echo "<div class='message-error'>عنوان سوال وارد نشده است.</div>";	
	}
	elseif ($text == ""){
	echo "<div class='message-error'>متن سوال وارد نشده است.</div>";	
							}
	elseif($db->sql_query(" INSERT INTO `faq` (title,view,text) VALUES 
			('$title', '0', '$text')")) {
	
	
	echo "<div class='message-success'>سوال متداول با موفقیت افزوده شد.</div>";
			} else {
	echo "<div class='message-error'>ارسال سوال متداول با خطا روبرو شد.</div>";	
}
}
	
	?>