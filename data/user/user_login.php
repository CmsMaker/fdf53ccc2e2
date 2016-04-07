<?php
session_start();
include "../../config.php";
include "../../include/jdf.php";
include "../../include/mysql.class.php";
include "../../include/handler.class.php";

	# new Code ( SMS )
	
	$funcPath = 
		$_SERVER[ 'DOCUMENT_ROOT' ] . DIRECTORY_SEPARATOR . "include" . DIRECTORY_SEPARATOR . "func.php";
	require_once( $funcPath );
	
	# End

/* ( SMS )
$db = new Mysql($host,$dbuname,$dbpass,$dbname,false); //create database object
$db->Database_Connect(); //connect to database
*/

	$mysqli = getMySqlHandel();
	$handler = new my_handler;

	$username = $mysqli->real_escape_string( $_POST[ 'username' ] );	
	$password = md5( $_POST[ 'password' ] );
	
	$r = $mysqli->query( "SELECT * FROM user WHERE username='{$username}' AND password='{$password}'" );
	
	
	if( $r->num_rows > 0) {
		
		
		$User = $r->fetch_assoc();
		
		
		
		$handler->set_session( "user" , $User['username'] );
		
		sendSmsToUser( 2 );
		
			echo "<p style='color:green;font-size:14px''>با موفقیت وارد شدید. منتظر بمانید.</p>
			<script type=\"text/javascript\" language=\"javascript\">
			window.open(\"user\",\"_self\");
			</script>
			";							
			
	}
	else
	{
		echo "<p style='color:red; font-size:14px'>نام کاربری یا رمز عبور اشتباه می باشد</p>";
	}
	
?>