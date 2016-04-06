<?php
include "../config.php";
include "../include/jdf.php";
include "../include/mysql.class.php";
$db = new Mysql($host,$dbuname,$dbpass,$dbname,false); //create database object
$db->Database_Connect(); //connect to database

session_start();
if ( isset($_SESSION['user']) ) {
 $db->sql_query ("SELECT * FROM `user` WHERE `username`='".$_SESSION['user']."'");
$data = $db->sql_fetcharray();

$ip = $_SERVER['REMOTE_ADDR'];

function today()
{
	global $db;
$y = date("Y");
$m = date("m");
$d = date("d");
$today_date = gregorian_to_jalali($y,$m,$d);
	$db->sql_query ("SELECT * FROM `user` WHERE `username`='".$_SESSION['user']."'");
$fetch_info = $db->sql_fetcharray();

if($fetch_info['today'] !== $today_date){
$db->sql_query("UPDATE `user` SET today='".$today_date."',yesterday_hit='".$fetch_info['today_hit']."',today_hit=0 WHERE `username`='".$_SESSION['user']."'");
				}
}



$msg = "<meta charset=\"utf-8\"><p style=\"font-family:tahoma;font-size:15px;text-align:center;direction:rtl;padding-top:200px;color:#f00\">ورود شما غیر قانونی تلقی شده است.
<br>
این صفحه را ببندید و به صفحه کسب درآمد مراجعه کرده و بعد از Refresh صفحه کسب درآمد، مجددا بر روی گزینه \"شروع کسب درآمد\" کلیک نمائید.
</p>";
$msg_ip = "<meta charset=\"utf-8\"><p style=\"font-family:tahoma;font-size:15px;text-align:center;direction:rtl;padding-top:200px;color:#f00\">ورود شما غیر قانونی تلقی شده است.
<br>
شما با نام کاربری دیگری نیز اقدام به کسب درآمد نموده اید. این کار تقلب به حساب می آید.
<br>
به صفحه شروع کسب درآمد مراجعه نموده و بر روی گزینه \"نادیده گرفتن تقلب\" کلیک نمائید.
</p>";

$msg_no_site = "<meta charset=\"utf-8\"><p style=\"font-family:tahoma;font-size:15px;text-align:center;direction:rtl;padding-top:200px;color:#f00\">در حال حاضر سایتی برای نمایش وجود ندارد.

</p>";

$msg_hit = "<meta charset=\"utf-8\"><p style=\"font-family:tahoma;font-size:15px;text-align:center;direction:rtl;padding-top:200px;color:#f00\">در روز حداکثر 3500 بازدید میتوانید انجام دهید.

</p>";


if($data['status'] == "1")
{



if (isset($_GET['sec_id'])){
	
	
	if ($db->sql_getrows("SELECT * FROM `sec_info` WHERE `username`='".$_SESSION['user']."' AND `status`=0 ") == 1) {
		
		if ($db->sql_getrows("SELECT * FROM `sec_info` WHERE  `ip`='".$ip."'") == 1) {
			
			if ($db->sql_getrows("SELECT * FROM `sec_info` WHERE  `sec_id`='".$_GET['sec_id']."'") == 1) {
				
				$timestamp = time() + 600;
				if($db->sql_getrows("SELECT * FROM `sites` WHERE `status`='1' AND `credit` > 0") > 0){
				$db->sql_query("SELECT * FROM `sites` WHERE `credit` > 0 AND `status`='1' ORDER BY RAND() LIMIT 1");
				$site = $db->sql_fetcharray();
				$credit = $site['credit'] - 1;
				$view = $site['view'] + 1;
				$refer = $user_cost / $from_refer;
				
				$db->sql_query("UPDATE `sec_info` SET status='1' WHERE `sec_id`='".$_GET['sec_id']."'");
				
				include"launch_2.php";

				$db->sql_query("UPDATE `user` SET mony=mony+$user_cost,today_hit=today_hit+1,total_hit=total_hit+1,timestamp='".$timestamp."' WHERE `username`='".$_SESSION['user']."'");
				$db->sql_query("UPDATE `stats` SET today_hit=today_hit+1,total_hit=total_hit+1");
				$db->sql_query("UPDATE `user` SET mony=mony+$refer WHERE `username`='".$data['refer']."'");
				$db->sql_query("UPDATE `sites` SET  view=$view,credit=$credit WHERE `id`='".$site['id']."'");
				
				today();
				
				}else {echo $msg_no_site;}
				
			}else {echo $msg;}
			
		}else {echo $msg_ip;}
		
	} else {echo $msg;}

}


}
elseif($data['status'] == "0")
{
	include "activate.php";

}
 elseif($data['status'] == "2")
{
	include "blocked.php";

 }
 
  }   else { header("Location: ../index.php"); }
  
  
  
  mysql_close();
  
  
   ?>