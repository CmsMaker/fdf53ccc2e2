<?php
session_start();
if ( isset($_SESSION['admin']) ) {

include "../../../config.php";
include "../../../include/jdf.php";
include "../../../include/mysql.class.php";
$db = new Mysql($host,$dbuname,$dbpass,$dbname,false);
$db->Database_Connect();
$y = date("Y"); //selected year from date
$m = date("m"); //selected month from date
$d = date("d"); //selected day from date
$date = gregorian_to_jalali($y, $m, $d);

if(isset($_POST['title'])) {
	$title = $_POST['title'];
	$newstext = $_POST['text'];
	}

	if ($title == ""){
	echo "<div class='message-error'>عنوان خبر وارد نشده است.</div>";	
	}
	elseif ($newstext == ""){
	echo "<div class='message-error'>متن خبر وارد نشده است.</div>";	
							}
	elseif($db->sql_query(" INSERT INTO `news` (title,date,text,view) VALUES 
			('$title', '$date', '$newstext','0')")) {
	
	
	echo "<div class='message-success'>خبر با موفقیت افزوده شد.</div>";
			} else {
	echo "<div class='message-error'>ارسال خبر با خطا روبرو شد.</div>";	
}
}
	
	?>