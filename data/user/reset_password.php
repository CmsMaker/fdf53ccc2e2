<?php
session_start();
include "../../config.php";
include "../../include/mysql.class.php";
$db = new Mysql($host,$dbuname,$dbpass,$dbname,false); //create database object
$db->Database_Connect(); //connect to database
	
	$email = $_POST['email'];
	$pass = rand(11111111,99999999);
	$pass_md5 = md5($pass);
	$db->sql_query("SELECT * FROM `user` WHERE `email`='".$_POST['email']."'");
	$fetch = $db->sql_fetcharray();
	if($email == ""){
		echo "<div class='message-error'>آدرس ایمیل را وارد نمائید.</div>";
		
	}
elseif($db->sql_getrows("SELECT * FROM `user` WHERE `email`='".$_POST['email']."'") > 0 )
{
		$db->sql_query("UPDATE `user` SET password='".$pass_md5."' WHERE `email`='".$_POST['email']."'");
		include "pass_mail.php";
		echo "<div class='message-success'>کلمه عبور جدید به آدرس ایمیل شما ارسال شد.</div>";
		} else {
		echo "<div class='message-error'>کاربری با این آدرس ایمیل وجود ندارد.</div>";	
		}

?>