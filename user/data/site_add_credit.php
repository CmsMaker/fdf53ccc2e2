<?php
session_start();
if ( isset($_SESSION['user']) ) {
include "../../config.php";
include "../../include/mysql.class.php";
$db = new Mysql($host,$dbuname,$dbpass,$dbname,false);
$db->Database_Connect();

$site_id = $_POST['site_id'];
$credit = $_POST['credit'];

$db->sql_query("SELECT * FROM `user` WHERE `username`='".$_SESSION['user']."'");
$fetch = $db->sql_fetcharray();


 if($credit == "") {
	echo "<div class='message-error'>تعداد بازدید را مشخص نمائید.</div>";
}
elseif(!is_numeric($credit)) {
	echo "<div class='message-error'>ساختار بازدید باید عددی باشد.</div>";
}
elseif($credit > $fetch['credit']) {
	echo "<div class='message-error'>تعداد بازدید بیشتر از موجودی شما می باشد.</div>";
}
elseif($credit == 0 || $credit < 0) {
	echo "<div class='message-error'>تعداد بازدید نامعتبر است.</div>";
} else {
	$db->sql_query("UPDATE `user` SET `credit`=credit-$credit WHERE `username`='".$_SESSION['user']."'");
	$db->sql_query("UPDATE `sites` SET `credit`=credit+$credit WHERE `id`='".$site_id."'"); {
		echo "<div class='message-success'>بازدید افزوده شد.</div>";
	}
}
}
?>