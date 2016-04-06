<?php
session_start();
if ( isset($_SESSION['admin']) ) {

include "../../../config.php";
include "../../../include/mysql.class.php";
$db = new Mysql($host,$dbuname,$dbpass,$dbname,false);
$db->Database_Connect();

if(isset($_POST['rule_page'])) {
	$rule_page = $_POST['rule_page'];
	$contact_page = $_POST['contact_page'];
	}

	if ($rule_page == ""){
	echo "<div class='message-error'>متن صفحه قوانین وارد نشده است.</div>";	
	}
	elseif ($contact_page == ""){
	echo "<div class='message-error'>متن صفحه تماس با ما وارد نشده است.</div>";	
							}
	elseif($db->sql_query("UPDATE `pages` SET rule='$rule_page' , contact='$contact_page'")) {
	
	
	echo "<div class='message-success'>تغییرات اعمال شد.</div>";
			} else {
	echo "<div class='message-error'>ثبت تغییرات با خطا روبرو شد.</div>";	
}
}
	
	?>