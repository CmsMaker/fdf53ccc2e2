<?php
session_start();
include "../../config.php";
include "../../include/jdf.php";
include "../../include/mysql.class.php";

	# new Code ( SMS )
	
	$funcPath = 
		$_SERVER[ 'DOCUMENT_ROOT' ] . DIRECTORY_SEPARATOR . "include" . DIRECTORY_SEPARATOR . "func.php";
	require_once( $funcPath );
	
	# End

/* ( SMS ) 
	$db = new Mysql($host,$dbuname,$dbpass,$dbname,false); //create database object
	$db->Database_Connect(); //connect to database
*/

	#new Code ( SMS )
	
	$mysqli = getMySqlHandel();
	
	#End

	$y = date("Y"); //selected year from date
	$m = date("m"); //selected month from date
	$d = date("d"); //selected day from date
	$date = gregorian_to_jalali($y, $m, $d);
	
/* ( SMS )
	$name = addslashes($_POST['name']);
	$mobile = $_POST['mobile'];
	$email = addslashes($_POST['email_adr']);
	$username = $_POST['username'];
	$pass = $_POST['pass'];
	$try_pass = $_POST['try_password'];
	$refer = $_POST['refer'];
	$md5 = md5($pass);
*/

	# new Code ( SMS )
		
	$name      = $mysqli->real_escape_string( $_POST[ 'name'      ] );	
	$mobile    = $mysqli->real_escape_string( $_POST[ 'mobile'    ] );
	$email     = $mysqli->real_escape_string( $_POST[ 'email_adr' ] );
	$username  = $mysqli->real_escape_string( $_POST[ 'username'  ] );
	$refer     = $mysqli->real_escape_string( $_POST[ 'refer'     ] );
	
	# END
	
	# change if condition ( SMS )
	if( !uniqOnUserTable( "email", $email, $mysqli ) ) {
		
		echo "<div class='message-error'>این ایمیل قبلا ثبت شده است</div>";
		
	} # change if condition ( SMS )
	else if( !uniqOnUserTable( "username", $username, $mysqli ) ) {
		
		echo "<div class='message-error'>این نام کاربری قبلا ثبت شده است</div>";
		
	} # change if condition ( SMS )
	else if( uniqOnUserTable( "mobile", $mobile, $mysqli ) ) {
		
		echo "<div class='message-error'>این شماره موبایل قبلا ثبت شده است</div>";
		
	}
	else {
		
		# change if condition ( SMS )
		if( empty( $name ) ) {
			
			echo "<div class='message-error'> نام و نام خانوادگی وارد نشده است</div>";
		
		} # change if condition ( SMS )
		else if( empty( $mobile ) ) {
			
			echo "<div class='message-error'>شماره موبایل وارد نشده است.</div>";
				
		} # change if condition ( SMS )
		else if( !correctMobileNumber( $mobile ) ) {
			
			echo "<div class='message-error'>شماره موبایل نا معتبر مي باشد</div>";
				
		} # change if condition ( SMS )
		else if( empty( $username ) ) {
			
			echo "<div class='message-error'>نام کاربری وارد نشده است.</div>";
			
		} # change if condition ( SMS )
		else if( empty( $email ) ) {
			
			echo "<div class='message-error'>آدرس ایمیل وارد نشده است.</div>";
				
		} # change if condition ( SMS )
		else if( !correctEmailAddress( $email ) ) {
			
			echo "<div class='message-error'>ایمیل نا معتبر می باشد</div>";
				
		} # change if condition ( SMS )
		else if( empty( $_POST['pass'] ) ) {
			
			echo "<div class='message-error'> کلمه عبور وارد نشده است.</div>";
				
		} # change if condition ( SMS )
		else if(  $_POST['pass'] != $_POST['try_password'] ) {
			
			echo "<div class='message-error'>کلمه عبور و تکرار کلمه عبور برابر نیستند</div>";
			
		} # change if condition ( SMS )
		else if( strlen(  $_POST['pass'] ) < 4 ) {
			
			echo "<div class='message-error'>كلمه عبور نمي تواند كمتر از 4 كاركتر باشد</div>";
			
		} # change if condition ( SMS )
		else if( $refer != "" && uniqOnUserTable( "username", $refer, $mysqli ) ) {
			
			echo "<div class='message-error'>معرفی با این نام کاربری در سیستم ما وجود ندارد.</div>";
			
		}
		else {
			
			# new Code ( SMS )
			
			$sql  = "INSERT INTO user ( name, email, mobile, username, password, refer, ";
			$sql .= "status, reg_date, credit, mony, today_hit, yesterday_hit, total_hit, ";
			$sql .= "today, level, refering ) VALUES ( ";
			$sql .= "'{$name}', '{$email}', '{$mobile}', '{$username}', '" . md5( $_POST['pass'] ) . "', ";
			$sql .= "'{$refer}', '1', '" . gregorian_to_jalali( $y, $m, $d ) . "', ";
			$sql .= "'0', '0', '0', '0', '0', '{$data}', '1', '0' )";
			
			# End
			
			/* ( SMS )
			$db->sql_query( "
				INSERT INTO `user` (name,email,mobile,username,password,refer,status,reg_date,credit,mony,today_hit,yesterday_hit,total_hit,today,level,refering) VALUES 
				('$name', '$email', '$mobile', '$username', '$md5', '$refer', '1', '".gregorian_to_jalali($y,$m,$d)."', '0', '0', '0', '0', '0','$date','1','0')
			");
			*/
			
			# new Code ( SMS )
			
			$mysqli->query( $sql );
			
			# End
			
			# new Code ( SMS )
			
			$_SESSION[ 'user' ] = $username;
			sendSmsToUser( 1 );
			unset( $_SESSION[ 'user' ] );
			
			# End
				
				
			include "reg_mail.php";
				
			echo "<div class='message-success'>ثبت نام با موفقیت انجام شد. میتوانید در سیستم فعالیت نمائید</div>";
		}
	}		
	
	
?>