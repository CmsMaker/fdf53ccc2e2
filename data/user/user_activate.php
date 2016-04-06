<?php
session_start();
include "../../config.php";
include "../../include/jdf.php";
include "../../include/mysql.class.php";
$db = new Mysql($host,$dbuname,$dbpass,$dbname,false); //create database object
$db->Database_Connect(); //connect to database
	
	$code = $_POST['code'];
	
$db->sql_query("SELECT * FROM `activate_code` WHERE `username`='".$_SESSION['user']."'"); 
$data = $db->sql_fetcharray();
if($data['code'] == $code )
{
		$db->sql_query("UPDATE `user` SET status='1' WHERE `username`='".$_SESSION['user']."'");
		echo "<div class='message-success'>حساب کاربری شما فعال شد. صفحه را Refresh نمائید.</div>";
		
	} elseif($code == "") {
		echo "<div class='message-error'>کد وارد نشده است</div>";
		} else {
		echo "<div class='message-error'>کد وارد شده صحیح نیست</div>";	
		}

?>