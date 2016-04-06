<?php
session_start();
	if(isset($_SESSION['user'])) {
include "../config.php";
include "../include/jdf.php";
include "../include/mysql.class.php";

$ip = $_SERVER['REMOTE_ADDR'];

$db = new Mysql($host,$dbuname,$dbpass,$dbname,false);
$db->Database_Connect();
function send($url,$api,$amount,$redirect){
$ch = curl_init();
curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch,CURLOPT_POSTFIELDS,"api=$api&amount=$amount&redirect=$redirect");
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
$res = curl_exec($ch);
curl_close($ch);
return $res;
}
$url = 'http://payline.ir/payment/gateway-send';
$api = $payline;
$amount = $refering_activation;
$redirect = "$link/user/refer_result_payment.php";
	
$result = send($url,$api,$amount,$redirect);
if($result > 0 && is_numeric($result)){
	$db->sql_query("INSERT INTO `pay_info` (id_get,trans_id,amount,username,status,ip) VALUES 
	('$result','0', '$amount', '{$_SESSION['user']}','0','$ip')");
$go = "http://payline.ir/payment/gateway-$result";

header("Location: $go");
}
	}
?>