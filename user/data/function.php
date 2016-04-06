<?php
if ( isset($_SESSION['user']) ) {


//Alexa Function
  function alexa($url){
$sWebSite= $url;
if($source = simplexml_load_file('http://data.alexa.com/data?cli=10&url='.$sWebSite)){
if($source->SD->COUNTRY['RANK']){
$country    = $source->SD->COUNTRY['RANK'];
$country_name = $source->SD->COUNTRY['NAME'];
}else{
$country='یافت نشد';
}
if($source->SD->POPULARITY['TEXT']){
 $popularity     = $source->SD->POPULARITY['TEXT'];
}else{
 $popularity='یافت نشد';
 }
if($source->SD->REACH['RANK']){
 $reach=$source->SD->REACH['RANK'];
 }else{
 $reach='یافت نشد';
}
 }else{
 $country='یافت نشد';
 $popularity='یافت نشد';
  $reach='یافت نشد';
}
  
echo '<tr><td width="129" class="info_td">رتبه الکسای ایران  :</td> <td>'.$country.'</td></tr>';
  }
  
  
	function wait_status(){
		global $db;
	$db->sql_query("SELECT COUNT(*) FROM `sites` WHERE `status`='0' AND `username`='".$_SESSION['user']."'");
	$pocet = $db->sql_fetcharray();
	$pocet = $pocet[0];
	
	echo $pocet;
	}
	
	function active_status(){
		global $db;
	$db->sql_query("SELECT COUNT(*) FROM `sites` WHERE `status`='1' AND `username`='".$_SESSION['user']."'");
	$pocet = $db->sql_fetcharray();
	$pocet = $pocet[0];
	
	echo $pocet;
	}
	
	function stop_status(){
		global $db;
	$db->sql_query("SELECT COUNT(*) FROM `sites` WHERE `status`='2' AND `username`='".$_SESSION['user']."'");
	$pocet = $db->sql_fetcharray();
	$pocet = $pocet[0];
	
	echo $pocet;
	}
	function user_today_hit(){
	 global $db;
	 
	 $db->sql_query("SELECT * FROM `user` WHERE `username`='".$_SESSION['user']."'");
	 
	 $today = $db->sql_fetcharray();
	 
	 echo $today['today_hit'];	
	}
	
	function user_yesterday_hit(){
	 global $db;
	 
	 $db->sql_query("SELECT * FROM `user` WHERE `username`='".$_SESSION['user']."'");
	 
	 $yesterday = $db->sql_fetcharray();
	 
	 echo $yesterday['yesterday_hit'];	
	}
	
	function user_total_hit(){
	 global $db;
	 
	 $db->sql_query("SELECT * FROM `user` WHERE `username`='".$_SESSION['user']."'");
	 
	 $total = $db->sql_fetcharray();
	 
	 echo $total['total_hit'];	
	}
	
	function user_pays(){
	 global $db;
	 $db->sql_query("SELECT * FROM `pays` WHERE `username`='".$_SESSION['user']."'"); 
while($pays = $db->sql_fetcharray()){
	 $user_pays +=$pays['amount'];
}
	echo"$user_pays";
  }
  
  function user_earned(){
	 global $db;
	 $db->sql_query("SELECT * FROM `paid_request` WHERE `username`='".$_SESSION['user']."'"); 
while($earned = $db->sql_fetcharray()){
	 $user_earned +=$earned['amount'];
}
	echo"$user_earned";
  }
  
  
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
if($fetch_info['level_timestamp'] < time()){
	
	$db->sql_query("UPDATE `user` SET level='1' WHERE `username`='".$_SESSION['user']."'");
	
}
}



function tickets(){
		global $db;
	$db->sql_query("SELECT COUNT(*) FROM `ticket_admin` WHERE `status`='0' AND `username`='".$_SESSION['user']."'");
	$pocet = $db->sql_fetcharray();
	$pocet = $pocet[0];
	
	echo $pocet;
	}




}


?>