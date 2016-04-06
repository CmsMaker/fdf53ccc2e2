<?php
session_start();
include "../../config.php";
include "../../include/mysql.class.php";
$db = new Mysql($host,$dbuname,$dbpass,$dbname,false);
$db->Database_Connect();

$bank_owner = $_POST['bank_owner'];
$bank_number = $_POST['bank_number'];
$bank_cart = $_POST['bank_cart'];
$bank_shaba = $_POST['bank_shaba'];
$bank_name = $_POST['bank_name'];

$db->sql_query("SELECT * FROM `user` WHERE `username`='".$_SESSION['user']."'");
$fetch = $db->sql_fetcharray();

if($bank_owner == "") {
	echo "<div class='message-error'>نام صاحب حساب وارد نشده است.</div>";
} elseif($bank_number == "") {
	echo "<div class='message-error'>شماره حساب وارد نشده است.</div>";
} elseif($bank_cart == "") {
	echo "<div class='message-error'>شماره کارت وارد نشده است.</div>";
}elseif($bank_shaba == "") {
	echo "<div class='message-error'>شماره شبا وارد نشده است.</div>";
} else {
	if($db->sql_query("UPDATE `user` SET bank_owner='$bank_owner',bank_number='$bank_number',bank_cart='$bank_cart',bank_shaba='$bank_shaba',bank_name='$bank_name' WHERE `username`='".$_SESSION['user']."'")) {
		echo "<div class='message-success'>اطلاعات بانکی با موفقیت ذخیره شد.</div>";
	}
}
?>