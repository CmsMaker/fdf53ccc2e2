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

if(isset($_POST['bank_name'])) {
	$bank_name = $_POST['bank_name'];
	}

	if ($bank_name == ""){
	echo "<div class='message-error'>نام بانک وارد نشده است.</div>";	
	}
	elseif($db->sql_query(" INSERT INTO `bank_name` (bank_name) VALUES 
			('$bank_name')")) {
	
	
	echo "<div class='message-success'>نام بانک جدید با موفقیت افزوده شد.</div>";
			} else {
	echo "<div class='message-error'>افزودن بانک جدید با خطا روبرو شد.</div>";	
}
}
	
	?>