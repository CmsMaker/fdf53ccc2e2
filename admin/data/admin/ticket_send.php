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

if(isset($_POST['user'])) {
	$username = $_POST['user'];
	$title = $_POST['title'];
	$text = $_POST['text'];
	$status = $_POST['status'];
	$all = "1";
	
	if($status == "OneMember" && $username == "") {
	echo "<div class='message-error'>نام کاربری وارد نشده است.</div>";
} elseif($title == "") {
	echo "<div class='message-error'>عنوان پیام وارد نشده است.</div>";
} elseif($text == "") {
	echo "<div class='message-error'>متن پیام وارد نشده است.</div>";
} else {

	
	$db->sql_query("SELECT * FROM `user` WHERE `username`='{$username}'");
	$user_info = $db->sql_fetcharray();
	
	if($status == "OneMember")
	{
		$sql = "
			INSERT INTO `ticket_admin` (username,title,text,date,status) VALUES 
			('{$user_info['username']}', '$title', '$text', '$date' ,'0')
		";
				
		if($db->sql_getrows("SELECT * FROM `user` WHERE `username`='{$username}'") > 0)
		{
			if($db->sql_query($sql))
			{
				echo "<div class='message-success'>پیام شما با موفقیت به کاربر مورد نظر ارسال شد</div>";
			}
			else
			{
				echo "<div class='message-error'>پیام شما با خطا مواجه شد.</div>";
			}
		}
		else
		{
			echo "<div class='message-error'>اطلاعات کاربر اشتباه می باشد.</div>";
		}
	
	}
	elseif($status == "AllMember")
	{
		$sql = "
			INSERT INTO `ticket_admin` (title,text,status,date,all_users) VALUES 
			('$title', '$text', '0','$date','1')
		";
		
			if($db->sql_query($sql))
			{
				echo "<div class='message-success'> پیام شما به تمامی کاربران ارسال شد.</div>";
			}
			else
			{
				echo "<div class='message-error'>پیام شما با خطا مواجه شد.</div>";
			}
	}
}
}
}
?>