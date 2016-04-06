<?php
include "../config.php";
include "../include/jdf.php";
include "../include/mysql.class.php";
$db = new Mysql($host,$dbuname,$dbpass,$dbname,false); //create database object
$db->Database_Connect(); //connect to database

session_start();
if ( isset($_SESSION['user']) ) {
	
	$ip = $_SERVER['REMOTE_ADDR'];


$db->sql_query ("SELECT * FROM `user` WHERE `username`='".$_SESSION['user']."'");
$data = $db->sql_fetcharray();

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


if($data['status'] == "1")
{
	
	
if (htmlspecialchars(isset($_GET['sec_id']))){
		
		
		if($db->sql_getrows("SELECT * FROM `sites` WHERE `status`='1' AND `credit` > 0") > 0){
		
			if ($db->sql_getrows("SELECT * FROM `site_sec_info` WHERE `username`='".$_SESSION['user']."' AND `status`=0 ") == 1) {
		
		if ($db->sql_getrows("SELECT * FROM `site_sec_info` WHERE  `ip`='".$ip."'") == 1) {
			
			if ($db->sql_getrows("SELECT * FROM `site_sec_info` WHERE  `sec_id`='".mysql_real_escape_string($_GET['sec_id'])."'") == 1) {
				
				
					
					
					
					
					
					switch($data['level']){
						
						case"1";
						$user_cost = $bronze_user_cost;
						$refer = $user_cost / $from_refer;
						break;
						case"2";
						$user_cost = $silver_user_cost;
						$refer = $user_cost / $from_refer;
						
						break;
						case"3";
						$user_cost = $golden_user_cost;
						$refer = $user_cost / $from_refer;
						break;
					}
					
					
					
					
				$db->sql_query("SELECT * FROM `sites` WHERE `credit` > 0 AND `status`='1' ORDER BY RAND() LIMIT 1");
				$site = $db->sql_fetcharray();
				
				$db->sql_query("UPDATE `site_sec_info` SET status='1' WHERE `sec_id`='".mysql_real_escape_string($_GET['sec_id'])."'");
				
				$db->sql_query("delete from site_sec_info where sec_id='".mysql_real_escape_string($_GET['sec_id'])."'");
				
				$credit = $site['credit'] - 1;
				$view = $site['view'] + 1;
				
				$timestamp = time() + 600;
				
				$db->sql_query("UPDATE `user` SET mony=mony+$user_cost,today_hit=today_hit+1,total_hit=total_hit+1,timestamp='".$timestamp."' WHERE `username`='".$_SESSION['user']."'");
				$db->sql_query("UPDATE `user` SET mony=mony+$refer WHERE `username`='".$data['refer']."'");
				$db->sql_query("UPDATE `stats` SET today_hit=today_hit+1,total_hit=total_hit+1");
				$db->sql_query("UPDATE `sites` SET  view=$view,credit=$credit WHERE `id`='".$site['id']."'");
				
				echo "<script type=\"text/javascript\" language=\"javascript\">
				window.open(\"{$site['url']}\",\"_self\");
				</script>";
				
				
				
				
				
				
				
			}else {echo $msg;}
			
		}else {echo $msg_ip;}
		
	} else {echo $msg;}
	
	}else {echo $msg_no_site;}

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
 
 
 
 mysql_close();
 
 
 
 
  }   else { header("Location: ../index.php"); }
  
  
  
  