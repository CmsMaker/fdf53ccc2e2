<?php
session_start();
if ( isset($_SESSION['admin']) ) {

include "../../../config.php";
include "../../../include/jdf.php";
include "../../../include/mysql.class.php";
$db = new Mysql($host,$dbuname,$dbpass,$dbname,false);
$db->Database_Connect();


if(isset($_POST['hostname']))
{
	$hostname = trim(addslashes(strip_tags($_POST['hostname'])));
	$dbusername = trim(addslashes(strip_tags($_POST['db_username'])));
	$db_password = trim(addslashes(strip_tags($_POST['db_password'])));
	$db_name = trim(addslashes(strip_tags($_POST['db_name'])));
	$hitcost = trim(addslashes(strip_tags($_POST['hit_cost'])));
	$bronze_usercost = trim(addslashes(strip_tags($_POST['bronze_user_cost'])));
	$silver_usercost = trim(addslashes(strip_tags($_POST['silver_user_cost'])));
	$golden_usercost = trim(addslashes(strip_tags($_POST['golden_user_cost'])));
	$fromrefer = trim(addslashes(strip_tags($_POST['from_refer'])));
	$min_request = trim(addslashes(strip_tags($_POST['min_request'])));
	$referingactivation = trim(addslashes(strip_tags($_POST['refering_activation'])));
	$levelsilvercost = trim(addslashes(strip_tags($_POST['level_silver_cost'])));
	$levelgoldencost = trim(addslashes(strip_tags($_POST['level_golden_cost'])));
	$payline_api = trim(addslashes(strip_tags($_POST['payline'])));
	$url = trim(addslashes(strip_tags($_POST['url'])));
	
	
	@chmod("../../../config.php", 0777);
	
	$open = fopen("../../../config.php","w");
	
	$body = '<?php' . "\r\n";
	$body .= '$host = ' . '"' . $hostname . '";' . "\r\n"; 
	$body .= '$dbuname = ' . '"' . $dbusername . '";' . "\r\n";
	$body .= '$dbpass = ' . '"' . $db_password . '";' . "\r\n";
	$body .= '$dbname = ' . '"' . $db_name . '";' . "\r\n";
	$body .= '$hit_cost = ' . '"' . $hitcost . '";' . "\r\n";
	$body .= '$bronze_user_cost = ' . '"' . $bronze_usercost . '";' . "\r\n";
	$body .= '$silver_user_cost = ' . '"' . $silver_usercost . '";' . "\r\n";
	$body .= '$golden_user_cost = ' . '"' . $golden_usercost . '";' . "\r\n";
	$body .= '$from_refer = ' . '"' . $fromrefer . '";' . "\r\n";
	$body .= '$request = ' . '"' . $min_request . '";' . "\r\n";
	$body .= '$refering_activation = ' . '"' . $referingactivation . '";' . "\r\n";
	$body .= '$level_silver_cost = ' . '"' . $levelsilvercost . '";' . "\r\n";
	$body .= '$level_golden_cost = ' . '"' . $levelgoldencost . '";' . "\r\n";
	$body .= '$payline = ' . '"' . $payline_api . '";' . "\r\n";
	$body .= '$link = ' . '"' . $url . '";' . "\r\n";
	
	$body .= '?>';
	
	if(fwrite($open, $body))
	{
		echo "<div class='message-success'>تنظیمات با موفقیت اعمال شد</div>";
	}
	else
	{
		echo "<div class='message-error'>تنظیمات با خطا روبرو شد.</div>";
	}
	fclose($open);
	
}

}
	?>