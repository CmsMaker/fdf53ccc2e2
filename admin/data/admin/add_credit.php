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

if(isset($_POST['credit'])) {
	$credit = $_POST['credit'];
	$username = $_POST['username'];
	}

	if ($credit == ""){
	echo "<div class='message-error'>تعداد اعتبار وارد نشده است.</div>";	
	}
	elseif ($credit == 0 || $credit < 0 || !is_numeric($credit)){
	echo "<div class='message-error'>اعتبار وارد شده نامعتبر است.</div>";	
							}
	elseif ($username == ""){
	echo "<div class='message-error'>نام کاربری وارد نشده است.</div>";	
							}
	elseif ($username == ""){
	echo "<div class='message-error'>نام کاربری وارد نشده است.</div>";	
							}
	elseif($db->sql_getrows("SELECT * FROM `user` WHERE `username`='".$username."'") > 0) {
	$db->sql_query("UPDATE `user` SET `credit`=credit+$credit WHERE `username`='$username'");
	echo "<div class='message-success'>تعداد اعتبار با موفقیت افزوده شد.</div>";
			} else {
	echo "<div class='message-error'>افزودن اعتبار با خطا روبرو شد.</div>";	
}



}
	
	?>