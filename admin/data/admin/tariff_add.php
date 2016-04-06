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

if(isset($_POST['tariff'])) {
	$tariff = $_POST['tariff'];
	}

	if ($tariff == ""){
	echo "<div class='message-error'>مبلغ تعرفه وارد نشده است.</div>";	
	}
	elseif (!is_numeric($tariff)){
	echo "<div class='message-error'>تعرفه را به صورت عددی وارد نمائید.</div>";	
	}
	elseif($db->sql_query(" INSERT INTO `tariff` (tariff) VALUES 
			('$tariff')")) {
	
	
	echo "<div class='message-success'>تعرفه جدید با موفقیت افزوده شد.</div>";
			} else {
	echo "<div class='message-error'>افزودن تعرفه جدید با خطا روبرو شد.</div>";	
}
}
	
	?>