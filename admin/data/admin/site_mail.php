<?php
$db->sql_query("SELECT * FROM mail_reg");

$row = $db->sql_fetcharray();

	$email = $user_info['email'];
	$headers  = "MIME-Version: 1.0\r\n";
	$headers .= "Content-type: text/html; charset=utf-8\r\n";
	$headers .= "From: {$row['name']} <{$row['email']}>\r\n";
	$mailTxt = "
	<html dir='rtl'>
		<body>
			<div style='margin:0 auto;direction:rtl;text-align:right;font-family:tahoma;'>
			
			<font size='2'>
			سلام {$user_info['name']} عزیز.
			<br>
			
			</font>
			<font color='red'>
			{$msg}
			</font>
			<br>
			شناسه سایت : {$id}
			<br>
			عنوان سایت : {$site_info['title']}
			<br>
			آدرس سایت : {$site_info['url']}
			<br>
			اعتبار افزوده شده : {$site_info['credit']}
			<br>
			<hr>
			</div>
		</body>
	</html>";
	if(@mail($email, $subject, $mailTxt, $headers))
		echo "";	
		else
		echo "";

?>