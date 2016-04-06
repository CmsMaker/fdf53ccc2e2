<?php
include "../config.php";
include "../include/jdf.php";
include "../include/mysql.class.php";
$db = new Mysql($host,$dbuname,$dbpass,$dbname,false); //create database object
$db->Database_Connect(); //connect to database
$y = date("Y"); //selected year from date
$m = date("m"); //selected month from date
$d = date("d"); //selected day from date
$date = gregorian_to_jalali($y, $m, $d);


	
	?>

<style type="text/css">
.error_pay {
	margin-top:300px;
	width:100%;
	padding:20px 0px 20px 0px;
	-moz-border-radius:10px;
	-webkit-border-radius:10px;
	border-radius:10px;
	border:1px solid #F00;
	background:#F99;
	color:#F00;
	font-family:tahoma;
	font-size:14px;
	font-weight:bold;
	text-align:center;
	direction:rtl;
}
.error_pay a{

	color:#F00;
}
.success_pay {
	margin-top:300px;
	width:100%;
	padding:20px 0px 20px 0px;
	-moz-border-radius:10px;
	-webkit-border-radius:10px;
	border-radius:10px;
	border:1px solid #0C0;
	background:#0F9;
	color:#090;
	font-family:tahoma;
	font-size:14px;
	font-weight:bold;
	text-align:center;
	direction:rtl;
}
.success_pay a{

	color:#090;
}
</style>
<?php 



function get($url,$api,$trans_id,$id_get){
$ch = curl_init();
curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch,CURLOPT_POSTFIELDS,"api=$api&id_get=$id_get&trans_id=$trans_id");
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
$res = curl_exec($ch);
curl_close($ch);
return $res;
}

$trans_id = $_POST['trans_id'];
$id_get = $_POST['id_get'];
$db->sql_query("SELECT * FROM `pay_info` WHERE `id_get`='{$id_get}'");
 $pay_amount  = $db-> sql_fetcharray();
 $amount = $pay_amount['amount'];
	  
$url = 'http://payline.ir/payment/gateway-result-second';
$api = $payline;
$result = get($url,$api,$trans_id,$id_get);
	if($db->sql_getrows("SELECT * FROM `pays` WHERE `fish`='$trans_id'") > 0){
	 echo  "<div class='error_pay'>پرداخت شما نامعتبر می باشد.
	 </div>";
	}
	elseif($result == 1){
		
		$credit = $amount / $hit_cost;
		$credit2 = round($credit);
	$db->sql_query("UPDATE `user` SET `credit`=credit+$credit2 WHERE `username`='".$pay_amount['username']."'");

				$db->sql_query("INSERT INTO `pays` (fish,amount,username,date,type) VALUES 
	('$trans_id', '$amount', '".$pay_amount['username']."', '$date','خرید بازدید')");

echo "<div class='success_pay'>پرداخت شما با موفقیت انجام پذیرفت و اعتبار به حساب شما افزوده شد.
<br>
برای مشاهده فیش، به صفحه سوابق شارژ حساب مراجعه نمائید.</div>";


	} 
	else {
	 echo "<div class='error_pay'>عملیات شما نامعتبر می باشد.
	 </div>";
	}
 
 ?>