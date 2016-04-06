<?php
if ( isset($_SESSION['admin']) ) {
	
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
	function all_users(){
		global $db;
	$db->sql_query("SELECT COUNT(*) FROM `user`");
	$pocet = $db->sql_fetcharray();
	$pocet = $pocet[0];
	
	echo $pocet;
	}
	function inactive_users(){
		global $db;
	$db->sql_query("SELECT COUNT(*) FROM `user` WHERE `status`='0'");
	$pocet = $db->sql_fetcharray();
	$pocet = $pocet[0];
	
	echo $pocet;
	}
	function blocked_users(){
		global $db;
	$db->sql_query("SELECT COUNT(*) FROM `user` WHERE `status`='2'");
	$pocet = $db->sql_fetcharray();
	$pocet = $pocet[0];
	
	echo $pocet;
	}
	function active_users(){
		global $db;
	$db->sql_query("SELECT COUNT(*) FROM `user` WHERE `status`='1'");
	$pocet = $db->sql_fetcharray();
	$pocet = $pocet[0];
	
	echo $pocet;
	}
	function all_sites(){
		global $db;
	$db->sql_query("SELECT COUNT(*) FROM `sites`");
	$pocet = $db->sql_fetcharray();
	$pocet = $pocet[0];
	
	echo $pocet;
	}
	function wait_status(){
		global $db;
	$db->sql_query("SELECT COUNT(*) FROM `sites` WHERE `status`='0'");
	$pocet = $db->sql_fetcharray();
	$pocet = $pocet[0];
	
	echo $pocet;
	}
	
	function active_status(){
		global $db;
	$db->sql_query("SELECT COUNT(*) FROM `sites` WHERE `status`='1'");
	$pocet = $db->sql_fetcharray();
	$pocet = $pocet[0];
	
	echo $pocet;
	}
	
	function stop_status(){
		global $db;
	$db->sql_query("SELECT COUNT(*) FROM `sites` WHERE `status`='2'");
	$pocet = $db->sql_fetcharray();
	$pocet = $pocet[0];
	
	echo $pocet;
	}
	
	function user_request(){
		global $db;
	$db->sql_query("SELECT COUNT(*) FROM `request`");
	$pocet = $db->sql_fetcharray();
	$pocet = $pocet[0];
	
	echo $pocet;
	}
	
	function unread_ticket(){
		global $db;
	$db->sql_query("SELECT COUNT(*) FROM `ticket` WHERE `status`='0'");
	$pocet = $db->sql_fetcharray();
	$pocet = $pocet[0];
	
	echo $pocet;
	}
	function today_hit(){
	 global $db;
	 $db->sql_query("SELECT * FROM `stats`"); 
$today = $db->sql_fetcharray();
	 $today_hit =$today['today_hit'];
	echo"$today_hit";
	
  }
	function yesterday_hit(){
	 global $db;
	 $db->sql_query("SELECT * FROM `stats`"); 
$yesterday = $db->sql_fetcharray();
	 $yesterday_hit =$yesterday['yesterday_hit'];
	echo"$yesterday_hit";
	
  }
  function total_hit(){
	  global $db;
	 $db->sql_query("SELECT * FROM `stats`"); 
$total = $db->sql_fetcharray();
	 $total_hit =$total['total_hit'];
	 echo "$total_hit";
	
  }
  function all_pays(){
	 global $db;
	 $db->sql_query("SELECT * FROM `paid_request`"); 
while($pays = $db->sql_fetcharray()){
	 $all_pays +=$pays['amount'];
}
	echo"$all_pays";
  }
  function all_earned(){
	 global $db;
	 $db->sql_query("SELECT * FROM `pays`"); 
while($earned = $db->sql_fetcharray()){
	 $all_earned +=$earned['amount'];
}
	echo"$all_earned";
  }
  
  
  function online_users(){
		global $db;
	$db->sql_query("SELECT COUNT(*) FROM `user` WHERE `timestamp` > '".time()."' ");
	$pocet = $db->sql_fetcharray();
	$pocet = $pocet[0];
	
	echo $pocet;
	}

}
?>