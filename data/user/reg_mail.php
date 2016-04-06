<?php
	
	$r = $mysqli->query( "SELECT * FROM mail_reg" );
	$row = $r->fetch_assoc();
	

	$subject  = "بازدید آپ - اطلاعات کاربری";
	$headers  = "MIME-Version: 1.0\r\n";
	$headers .= "Content-type: text/html; charset=utf-8\r\n";
	$headers .= "From: {$row['name']} <{$row['email']}>\r\n";
	$mailTxt = "
	<html dir='rtl'>
		<body>
			<div style='margin:0 auto;direction:rtl;text-align:right;font-family:tahoma;'>
			
			<font size='2'>
			سلام {$name} عزیز.
			<br>
			 شما با موفقیت در سامانه ما عضو شده اید. 
			<br>
			<br>
			
			</font>
			<br>
			شما با اطلاعات زیر در سامانه کسب درآمد ما عضو شده اید:
			<br>
			نام و نام خانوادگی : {$name}
			<br>
			آدرس ایمیل : {$email}
			<br>
			شماره موبایل : {$mobile}
			<br>
			نام کاربری : {$username}
			<br>
			کلمه عبور : {$pass}
			<br>
			<hr>
			<font color='#888' size='1'> کسب درآمد به ازای بازدید - بهبود حرفه ای رتبه الکسا <a href='http://basdid.tk' target='_blank'>ورود به سایت</a></font>
			</div>
		</body>
	</html>";
	if(@mail($email, $subject, $mailTxt, $headers))
		echo "";	
		else
		echo "";

?>