<?php
session_start();
if ( isset($_SESSION['admin']) ) {

include "../../../config.php";
include "../../../include/jdf.php";
include "../../../include/mysql.class.php";
$db = new Mysql($host,$dbuname,$dbpass,$dbname,false);
$db->Database_Connect();
$y = date("Y"); //selected year from date
$m = date("m"); //selected month from date
$d = date("d"); //selected day from date
$date = gregorian_to_jalali($y, $m, $d);

	$funcPath = 
		$_SERVER[ 'DOCUMENT_ROOT' ] . DIRECTORY_SEPARATOR . "include" . DIRECTORY_SEPARATOR . "func.php";
	require_once( $funcPath );

if(isset($_POST['amount'])) {
	$amount = $_POST['amount'];
	$username = $_POST['username'];
	$fish = $_POST['fish'];
	}

	if ($amount == ""){
	echo "<div class='message-error'>مبلغ مورد نظر وارد نشده است.</div>";	
	}
	elseif ($username == ""){
	echo "<div class='message-error'>نام کاربری وارد نشده است.</div>";	
							}
	elseif ($fish == ""){
	echo "<div class='message-error'>شماره فیش وارد نشده است.</div>";	
							}
	elseif($db->sql_getrows("SELECT * FROM `user` WHERE `username`='".$username."'") > 0) {
		
		$_SESSION[ 'user' ] = $username;
	
		sendSmsToUser( 11 );
		
		unset( $_SESSION[ 'user' ] );
		
	$db->sql_query(" INSERT INTO `paid_request` (amount,username,fish,date) VALUES 
			('$amount', '$username', '$fish','$date')");
	$db->sql_query("UPDATE `user` SET `mony`=mony-$amount WHERE `username`='$username'");
	echo "<div class='message-success'>فیش واریزی با موفقیت افزوده شد.</div>";
			} else {
	echo "<div class='message-error'>ثبت فیش با خطا روبرو شد.</div>";	
}



}
	
	?>