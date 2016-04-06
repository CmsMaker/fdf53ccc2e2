<?php
session_start();
include "../../config.php";
include "../../include/jdf.php";
include "../../include/mysql.class.php";
$db = new Mysql($host,$dbuname,$dbpass,$dbname,false); //create database object
$db->Database_Connect(); //connect to database

$y = date("Y"); //selected year from date
$m = date("m"); //selected month from date
$d = date("d"); //selected day from date
$date = gregorian_to_jalali($y, $m, $d);
	
	$name = addslashes($_POST['name']);
	$mobile = $_POST['mobile'];
	$email = addslashes($_POST['email_adr']);
	$username = $_POST['username'];
	$pass = $_POST['pass'];
	$try_pass = $_POST['try_password'];
	$refer = $_POST['refer'];
	$md5 = md5($pass);
	
	if($db->sql_getrows("SELECT * FROM `user` WHERE `email`='".$_POST['email_adr']."'") > 0) { //check username for correct
		echo "<div class='message-error'>این ایمیل قبلا ثبت شده است</div>";
	} elseif($db->sql_getrows("SELECT * FROM `user` WHERE `username`='".$_POST['username']."'") > 0) {
		echo "<div class='message-error'>این نام کاربری قبلا ثبت شده است</div>";
		}elseif($db->sql_getrows("SELECT * FROM `user` WHERE `mobile`='".$_POST['mobile']."'") > 0) {
		echo "<div class='message-error'>این شماره موبایل قبلا ثبت شده است</div>";
		}else {
		
			if($name == "") {
				echo "<div class='message-error'> نام و نام خانوادگی وارد نشده است</div>";
			}
			elseif($mobile == "") {
				echo "<div class='message-error'>شماره موبایل وارد نشده است.</div>";
			}  elseif((strlen($mobile) < 11) || (strlen($mobile) > 11) || !is_numeric($mobile)) {
				echo "<div class='message-error'>شماره موبایل نا معتبر مي باشد</div>";
			} elseif($username == "") {
				echo "<div class='message-error'>نام کاربری وارد نشده است.</div>";
			}
			elseif($email == "") {
				echo "<div class='message-error'>آدرس ایمیل وارد نشده است.</div>";
			}
			elseif(!preg_match("/[a-zA-Z0-9-_.]+@[a-zA-Z0-9-_.]+\.[a-zA-Z0-9-_.]+/", $email)) {
				echo "<div class='message-error'>ایمیل نا معتبر می باشد</div>";
			}
			elseif($pass == "") {
				echo "<div class='message-error'> کلمه عبور وارد نشده است.</div>";
			} elseif($try_pass !== $pass) {
				echo "<div class='message-error'>کلمه عبور و تکرار کلمه عبور برابر نیستند</div>";
			} elseif(strlen($pass) < 4) {
				echo "<div class='message-error'>كلمه عبور نمي تواند كمتر از 4 كاركتر باشد</div>";
			} elseif($refer !== "" && $db->sql_getrows("SELECT * FROM `user` WHERE `username`='".$refer."'") == 0) {
				echo "<div class='message-error'>معرفی با این نام کاربری در سیستم ما وجود ندارد.</div>";
			}else {

				$db->sql_query( "
					INSERT INTO `user` (name,email,mobile,username,password,refer,status,reg_date,credit,mony,today_hit,yesterday_hit,total_hit,today,level,refering) VALUES 
					('$name', '$email', '$mobile', '$username', '$md5', '$refer', '1', '".gregorian_to_jalali($y,$m,$d)."', '0', '0', '0', '0', '0','$date','1','0')
				");
				include "reg_mail.php";
				
				echo "<div class='message-success'>ثبت نام با موفقیت انجام شد. میتوانید در سیستم فعالیت نمائید</div>";
			}
}		
?>