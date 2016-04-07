<?php
session_start();
include "../config.php";
include "../include/jdf.php";
include "../include/mysql.class.php";
$db = new Mysql($host,$dbuname,$dbpass,$dbname,false); //create database object
$db->Database_Connect(); //connect to database
$y = date("Y"); //selected year from date
$m = date("m"); //selected month from date
$d = date("d"); //selected day from date
$date = gregorian_to_jalali($y, $m, $d);


	# new Code ( SMS )
	
	$funcPath = 
		$_SERVER[ 'DOCUMENT_ROOT' ] . DIRECTORY_SEPARATOR . "include" . DIRECTORY_SEPARATOR . "func.php";
	require_once( $funcPath );
	
	# End


?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
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
</head>
<body>
<?php 

	// new line
	
	
	
	if( !isset( $_SESSION['user'] ) ) {
		die();
	}
	
	include "../include/nusoap.php";
	
	$authority = mysql_real_escape_string ( $_GET['Authority'] );
	
	
	$db->sql_query( "SELECT * FROM pay_info WHERE id_get='{$authority}'");
	$payinfo  = $db->sql_fetcharray();
	
	$amount = $payinfo[ 'amount' ];
	$username   = $payinfo[ 'username' ];
	
	if( !isset( $amount ) ) {
		
		echo "<div class='error_pay'>عملیات شما نامعتبر می باشد.<br><a href='index.php'>بازگشت</a></div>";
		
	} else if( $db->sql_getrows( "SELECT * FROM `pays` WHERE `fish`='$authority'" ) > 0  ) {
		
		echo  "<div class='error_pay'>پرداخت شما ثبت شده است.<br><a href='index.php'>بازگشت</a></div>";
		
	} else {
		
		if( $_GET['Status'] == 'OK' ) {
			
			$amount = intval( $amount );
			$amount /= 10;
			
			$client = new nusoap_client('https://de.zarinpal.com/pg/services/WebGate/wsdl', 'wsdl'); 
			$client->soap_defencoding = 'UTF-8';
			
			$result = $client->call('PaymentVerification', array(
				array(
						'MerchantID'	 => $payline,
						'Authority' 	 => $authority,
						'Amount'	 	 => $amount
					)
				)
			);
			
			if($result['Status'] == 100){
				
				$amount *= 10;
				
				$credit = $amount / $hit_cost;
				$credit2 = round( $credit );
				
				$db->sql_query( "UPDATE user SET credit=credit+$credit2 WHERE username='{$username}'" );
				
				$sql  = "INSERT INTO pays (fish, amount, username, date, type) VALUES ";
				$sql .= "('{$authority}', '{$amount}', '{$username}', '{$date}','خرید بازدید' )";

				$db->sql_query( $sql );
				
				sendSmsToUser( 3, $result['RefID'], $amount );
				
				echo "<div class='success_pay'>";
				echo  "پرداخت شما با موفقیت انجام پذیرفت و اعتبار به حساب شما افزوده شد.";
				echo  "<br>";
				echo  "شماره پیگیری: " . $result['RefID'];
				echo  "<br>";
				echo 	"برای مشاهده فیش، به صفحه سوابق شارژ حساب مراجعه نمائید.";
				echo 	"<br><a href='index.php'>بازگشت</a>";
				echo  "</div>";

			} else {
				
				echo  "<div class='error_pay'>پرداخت شما نامعتبر می باشد.<br><a href='index.php'>بازگشت</a></div>";
				
			}
			
		} else {
			
			echo "<div class='error_pay'>عملیات شما نامعتبر می باشد.<br><a href='index.php'>بازگشت</a></div>";
			
		}
		
	}
	
	// end
 ?>
 </body>
 </html>