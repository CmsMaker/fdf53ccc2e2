<?php

	session_start();

	if( isset( $_SESSION['user'] ) ) {
		
		include "../config.php";
		include "../include/jdf.php";
		include "../include/mysql.class.php";
		
		// new line
		include "../include/nusoap.php";
		// end 
		
		
		$db = new Mysql( $host,$dbuname,$dbpass,$dbname,false );
		$db->Database_Connect();
		
		
		
		// new Line
		
		$db->sql_query( "SELECT email, mobile FROM user WHERE username='" . $_SESSION['user'] . "' " );
		
		$info = $db-> sql_fetcharray();
		
		$email = $info[ 'email' ];
		$mobile = $info[ 'mobile' ];
		
		$amount = intval( $_POST['amount'] );
		$amount /= 10;
		
		$callback = "$link/user/result_payment.php";
		
		$client = new nusoap_client('https://de.zarinpal.com/pg/services/WebGate/wsdl', 'wsdl'); 
		$client->soap_defencoding = 'UTF-8';
		
		$result = $client->call('PaymentRequest', array(
			array(
					'MerchantID' 	=> $payline,
					'Amount' 		=> $amount,
					'Description' 	=> "افزایش اعتبار",
					'Email' 		=> $email,
					'Mobile' 		=> $mobile,
					'CallbackURL' 	=> $callback
				)
			)
		);
		
		if($result['Status'] == 100) {
			
			$ip = mysql_real_escape_string ( $_SERVER['REMOTE_ADDR'] );
			$authority = mysql_real_escape_string( $result['Authority'] );
			
			$amount *= 10;
			
			$sql  = "INSERT INTO pay_info ( id_get, trans_id, amount, username, status, ip ) ";
			$sql .= "VALUES ( '$authority', '0', '$amount', '" . $_SESSION[ 'user' ] . "', '0', '$ip' )";
			
			$db->sql_query( $sql );
			
			Header('Location: https://www.zarinpal.com/pg/StartPay/'.$result['Authority']);
			exit();
			
		} else {
			echo'ERR: '.$result['Status'];
		}
		
		// end 
		
	}
?>