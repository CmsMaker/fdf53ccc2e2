<?php
session_start();
if ( isset($_SESSION['user']) ) {
include "../../config.php";
include "../../include/jdf.php";
include "../../include/mysql.class.php";
$db = new Mysql($host,$dbuname,$dbpass,$dbname,false);
$db->Database_Connect();
$y = date("Y"); //selected year from date
$m = date("m"); //selected month from date
$d = date("d"); //selected day from date
$date = gregorian_to_jalali($y, $m, $d);
$amount = $_POST['amount'];

$db->sql_query("SELECT * FROM `user` WHERE `username`='".$_SESSION['user']."'");
$fetch = $db->sql_fetcharray();

if($amount == "" || $amount == 0 || $amount < 0) {
	echo "<div class='message-error'>مبلغ درخواستی را وارد نمائید.</div>";
}

elseif( $amount > $fetch['mony']) {
	echo "<div class='message-error'>مبلغ درخواستی بیشتر از درآمد شماست.</div>";
}
elseif( $amount < 5000) {
	echo "<div class='message-error'>کمتر از 5000 تومان نمیتوانید درخواست دهید.</div>";
} else {
	$db->sql_query( " INSERT INTO `request` (amount,username,date ) VALUES 
('$amount', '".$_SESSION['user']."', '$date')
				"); {
		echo "<div class='message-success'>درخواست شما ثبت گردید.</div>";
	}
}
}
?>