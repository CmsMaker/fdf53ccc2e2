  <?php

  


  function alexa(){
$sWebSite="http://bazdidup.ir";
if($source = simplexml_load_file('http://data.alexa.com/data?cli=10&url='.$sWebSite)){
if($source->SD->COUNTRY['RANK']){
$country    = $source->SD->COUNTRY['RANK'];
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
  
echo '<tr><td width="146" class="info_td">رتبه الکسای ایران  :</td> <td style="text-align:center">'.$country.'</td></tr>';
  }
  
  
  function top_users(){
	 global $db;
	 $db->sql_query("SELECT username,total_hit FROM `user` WHERE status='1' ORDER BY cast(total_hit as unsigned) DESC LIMIT 10"); 
	while( ($top_users = $db->sql_fetcharray()) && ($top_users['total_hit'] > 0)){
	 echo"<tr>
<td width=\"146\" class=\"info_td\"><p>".$top_users['username']."</p></td>
<td width=\"146\">بازدید ها : ".$top_users['total_hit']."</td>
</tr>";
	}
  }
	function all_users(){
		global $db;
	$db->sql_query("SELECT COUNT(*) FROM `user`");
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
	function active_sites(){
		global $db;
	$db->sql_query("SELECT COUNT(*) FROM `sites` WHERE `status`='1'");
	$pocet = $db->sql_fetcharray();
	$pocet = $pocet[0];
	
	echo $pocet;
	}
	
	function today_hit(){
	 global $db;
	 $db->sql_query("SELECT * FROM `stats`"); 
$today = $db->sql_fetcharray();
	 $today_hit = $today['today_hit'];

	echo $today_hit ;
	
  }
	function yesterday_hit(){
	 global $db;
	 $db->sql_query("SELECT * FROM `stats`"); 
$yesterday = $db->sql_fetcharray();
	 $yesterday_hit = $yesterday['yesterday_hit'];

	echo $yesterday_hit;
	
  }
  function total_hit(){
	  global $db;
	 $db->sql_query("SELECT * FROM `stats`"); 
$total = $db->sql_fetcharray();
	 $total_hit = $total['total_hit'];

	 echo $total_hit;
	
  }
  function all_pays(){
	 global $db;
  
  $db->sql_query("SELECT * FROM `paid_request`");
while($pays = $db->sql_fetcharray()) {

	$allpays += $pays['amount'];
}
echo $allpays;
  }
  
  function online_users(){
		global $db;
	$db->sql_query("SELECT COUNT(*) FROM `user` WHERE `timestamp` > '".time()."' ");
	$pocet = $db->sql_fetcharray();
	$pocet = $pocet[0];
	
	echo $pocet;
	}
	
	
function today()
{
	global $db;
$y = date("Y");
$m = date("m");
$d = date("d");
$today_date = gregorian_to_jalali($y,$m,$d);
	$db->sql_query ("SELECT * FROM `stats`");
$date = $db->sql_fetcharray();

if($date['today'] !== $today_date){
$db->sql_query("UPDATE `stats` SET today='".$today_date."',yesterday_hit='".$date['today_hit']."',today_hit=0");
				}
				


}
?>