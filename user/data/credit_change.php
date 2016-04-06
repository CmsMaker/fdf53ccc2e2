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
$credit = ($amount) / ($admin_cost + $user_cost);
$credit = round($credit);
$db->sql_query("SELECT * FROM `user` WHERE `username`='".$_SESSION['user']."'");
$fetch = $db->sql_fetcharray();

if($amount == "" || $amount == 0 || $amount < 0) {
	echo "<div class='message-error'>مبلغ مورد نظر را وارد نمائید.</div>";
}

elseif( $amount > $fetch['mony']) {
	echo "<div class='message-error'>مبلغ درخواستی بیشتر از درآمد شماست.</div>";
}
elseif(!is_numeric($amount) ) {
	echo "<div class='message-error'>مبلغ را به صورت عددی وارد نمائید.</div>";
} else {
	$db->sql_query( "UPDATE `user` SET `mony`=mony-$amount,`credit`=credit+$credit WHERE `username`='".$_SESSION['user']."'"); {
		echo "<div class='message-success'>مبلغ مورد نظر به موجودی تبلیغات تبدیل گردید.</div>";
	}
}
}
?>