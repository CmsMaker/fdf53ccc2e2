<?php

	function getMySqlHandel() {

		$configPath =
		 		$_SERVER[ 'DOCUMENT_ROOT' ] . DIRECTORY_SEPARATOR . "config.php";

		include( $configPath );

		$mysqli =
			new mysqli( $host, $dbuname, $dbpass, $dbname);

		$mysqli->query( 'SET NAMES utf8' );

		return $mysqli;

	}

	function getCurrentUser() {
		if( session_id() == '' ) {
			session_start();
		}

		if( !isset( $_SESSION[ 'user' ] ) ) {
			return false;
		}
		$username = $_SESSION[ 'user' ];

		$mysqli = getMySqlHandel();

		$result = $mysqli->query( "SELECT * FROM user WHERE username='$username'" );

		return $result->fetch_assoc();
	}

	function sendSmsToUser( $event , $fish = "", $amout = "" ) {

		$user = getCurrentUser();

		if( $user == false ) {
			die();
		}

		$mysqli = getMySqlHandel();

		$stmt = $mysqli->prepare( "SELECT fa FROM sms_types WHERE id=?" );
		$stmt->bind_param( "i", $event );

		$stmt->execute();
		$stmt->bind_result( $msg );
		$stmt->fetch();
		$stmt->close();

		if( !function_exists( 'irtime' ) ) {

			$classPath =
			 		$_SERVER[ 'DOCUMENT_ROOT' ] . DIRECTORY_SEPARATOR . "include"
					. DIRECTORY_SEPARATOR . "jdf.php";

			require_once( $classPath );

		}

		$currentTime = gregorian_to_jalali( date("Y"), date("m"), date("d") ). ' ' . irtime();
		$msg = "**ialexa**\n" . $msg;
		$msg = str_replace( "*U_NF*", $user[ 'username' ], $msg );
		$msg = str_replace( "*DT*", $currentTime, $msg );

		$msg = str_replace( "*AMT*", $amout, $msg );
		$msg = str_replace( "*FNO*", $fish, $msg );

		sendSms( $msg, $user[ 'mobile' ] );
	}

	function sendSms( $content , $number ) {

		$configPath =
		 		$_SERVER[ 'DOCUMENT_ROOT' ] . DIRECTORY_SEPARATOR . "config.php";

		include( $configPath );

		$client =
			new SoapClient(
				'http://www.novinpayamak.com/services/SMSBox/wsdl',
				array('encoding' => 'UTF-8')
			);

		$result = $client->Send(
			array(
					'Auth' 	=> array('number' => $smsPanleAPI,'pass' => $smsPanelPass),
					'Recipients' => array( $number ),
					'Message' => array( $content ),
					'Flash' => false
				)
		);
	}
	
	function uniqOnUserTable( $columnName, $value, &$mysqli = false ) {
		
		if( $mysqli == false ) {
			$mysqli = getMySqlHandel();
		}
		
		$sql = "SELECT * FROM user WHERE {$columnName}='{$value}'";
		
		$r = $mysqli->query( $sql );
		
		if( $r->num_rows > 0 ) {
			return false;
		} 
		else {	
			return true;
		}
	}
	
	function correctMobileNumber( $number ) {
		
		if( strlen( $number ) != 11 || !is_numeric( $number ) ) {
			return false;
		}
		else {
			return true;
		}
		
	}
	
	function correctEmailAddress( $email ) {
		
		$match = "/[a-zA-Z0-9-_.]+@[a-zA-Z0-9-_.]+\.[a-zA-Z0-9-_.]+/";
		if( preg_match( $match, $email) ) {
			return true;
		}
		else {
			return false;
		}
		
	}