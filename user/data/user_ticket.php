<?php
session_start();
include "../../config.php";
include "../../include/mysql.class.php";
include "../../include/jdf.php";

$db = new Mysql($host,$dbuname,$dbpass,$dbname,false);
$db->Database_Connect();
$y = date("Y"); //selected year from date
$m = date("m"); //selected month from date
$d = date("d"); //selected day from date
$date = gregorian_to_jalali($y, $m, $d);
$title = $_POST['title'];
$text = $_POST['text'];

 if($_POST['title'] == "") {
	echo "<div class='message-error'>عنوان تیکت پشتیبانی وارد نشده است.</div>";
} elseif($_POST['text'] == "") {
	echo "<div class='message-error'>متن تیکت پشتیبانی وارد نشده است.</div>";
} else {
	mysql_query( " INSERT INTO `ticket` (title,text,username,status,date ) VALUES 
('$title', '$text', '".$_SESSION['user']."', '0', '$date')
				"); {
		echo "<div class='message-success'>تیکت پشتیبانی شما برای مدیریت سامانه ارسال گردید.</div>";
	}
}
?>