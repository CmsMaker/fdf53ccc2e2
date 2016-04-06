<?php
session_start();
include "../../../config.php";
include "../../../include/jdf.php";
include "../../../include/mysql.class.php";
include "../../../include/handler.class.php";
$db = new Mysql($host,$dbuname,$dbpass,$dbname,false); //create database object
$db->Database_Connect(); //connect to database

$handler = new my_handler;

		if($db->sql_getrows("SELECT * FROM `admin` WHERE `username`='".$_POST['username']."' AND `password`='".md5($_POST['password'])."'") > 0) { //check username and md5(password)
			$db->sql_query("SELECT * FROM `admin` WHERE `username`='".$_POST['username']."' AND `password`='".md5($_POST['password'])."'");
			$User = $db->sql_fetcharray();
			$handler->set_session("admin",$User['username']); //set new session
			
				echo "<p style='color:green; font-size:14px'><a href='dashboard.php' style='color:#green'>با موفقیت وارد شدید . منتظر بمانید.</a></p>
				<script type=\"text/javascript\" language=\"javascript\">
				window.open(\"dashboard.php\",\"_self\");
				</script>
				";
	
		}
		else
		{
			echo "<p style='color:red; font-size:14px'>نام کاربری یا رمز عبور اشتباه می باشد</p>";
		}
?>