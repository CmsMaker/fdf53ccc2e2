<?php
$db->sql_query("SELECT * FROM mail_reg");

$row = $db->sql_fetcharray();
	

	$subject  = "بازیابی کلمه عبور - سامانه بازدید آپ";
	$headers  = "MIME-Version: 1.0\r\n";
	$headers .= "Content-type: text/html; charset=utf-8\r\n";
	$headers .= "From: {$row['name']} <{$row['email']}>\r\n";
	$mailTxt = "
	<html dir='rtl'>
		<body>
			<div style='margin:0 auto;direction:rtl;text-align:right;font-family:tahoma;'>
			
			<font size='2'>
			سلام {$fetch['name']} عزیز.
			<br>
			 بازیابی کلمه عبور شما موفقیت آمیز بوده است و کلمه عبور جدید شما در زیر درج شده است.
			<br>
			<br>
			
			</font>
			<font color='red'>
			کلمه عبور جدید : {$pass}
			</font>

			<hr>
			<font color='#888' size='1'> کسب درآمد به ازای بازدید - بهبود حرفه ای رتبه الکسا <a href='http://bazdidup.ir' target='_blank'>ورود به سایت</a></font>
			</div>
		</body>
	</html>";
	if(@mail($email, $subject, $mailTxt, $headers))
		echo "";	
		else
		echo "";

?>