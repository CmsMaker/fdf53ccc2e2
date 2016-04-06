<?php 
if ( isset($_SESSION['user']) ) {
$db->sql_query("SELECT * FROM `user` WHERE `username`='".$_SESSION['user']."'");
$data2 = $db->sql_fetcharray();

if($data2['status'] == "1")
{
	$text = "<font style='color:green'>فعال</font>";
}
else
{
	$text = "<font style='color:red'>غیر فعال</font>";
}

if($data2['refering'] == "1"){
	
	$refering = "<font color='green'>فعال</font>";
	
}else {
	$refering = "<font color='red'>غیر فعال</font>";
}


if($data2['level'] == "1"){
	
	$level = "<font color='green'>بــرنــزی</font>";
	
}elseif($data2['level'] == "2") {
	
	$level = "<font color='green'>نــقــره ای</font>";
	
}elseif($data2['level'] == "3") {
	
	$level = "<font color='green'>طـلـایــی</font>";
	
}


?>
<div class="right">
<div class="right_block">
<div class="right_block_top">
  <div class="right_block_top_text">اطلاعات کاربری</div>
</div>
<div class="right_block_content">
  <p><font color="#FF0000"><?php echo $data['name']; ?> </font> عزیز، خوش آمدی! </p>
  <p>وضعیت کاربری: <?php echo $text; ?></p>
  <p>تاریخ عضویت : <font dir="ltr"><?php echo $data['reg_date']; ?></font></p>
  
  <p>سطح کاربری: <font dir="ltr"><?php echo $level; ?></font></p>
  
  
  
  <p>امکان زیرمجموعه گیری: <font dir="ltr"><?php echo $refering; ?></font></p>
  
  
  
  
  
  <p>موجودی حساب:<font color="#006600"> <?php echo $data['credit']; ?> بازدید</font></p>
  <p>درآمد شما:<font color="#006600"> <?php echo $data['mony']; ?> ریال</font></p>
</div>
</div>
<div class="right_block">
<div class="right_block_top">
  <div class="right_block_top_text">منوی مدیریت</div>
</div>
<div class="right_block_content">
<ul>
<li><a href="index.php">پیشخوان کاربری</a></li>
<li style="font-weight:bold;color:#06C">مدیریت پنل کاربری</li>
<li><a href="bank_info.php">اطلاعات حساب بانکی</a></li>
<li><a href="ticket_send.php">ارسال تیکت پشتیبانی</a></li>
<li><a href="ticket_list.php">تیکت های پشتیبانی (<?php tickets(); ?>)</a></li>
<li><a href="change_pass.php">تغییر کلمه عبور</a></li>
<li style="font-weight:bold"><a href="?logout=true">خروج از مدیریت</a></li>
<li style="font-weight:bold;color:#06C">افزایش بازدید</li>
<li><a href="site_add.php">افزودن سایت</a></li>
<li><a href="site_manage.php">مدیریت سایت ها</a></li>
<li style="font-weight:bold;color:#06C">کسب درآمد</li>
<li><a href="start.php">شروع کسب درآمد</a></li>
<li><a href="upgrade_user_level.php">ارتقاء سطح کاربری</a></li>
<li><a href="refer_code.php">کد زیرمجموعه گیری</a></li>
<li><a href="refer_list.php">لیست زیرمجموعه ها</a></li>
<li><a href="refer_activate.php">فعال سازی زیرمجموعه گیری</a></li>
<li style="font-weight:bold;color:#06C">امور مالی</li>
<li><a href="pay.php">شارژ حساب</a></li>
<li><a href="pay_history.php">سوابق پرداخت های آنلاین</a></li>
<li><a href="request.php">درخواست واریز درآمد</a></li>
<li><a href="request_history.php">سوابق واریز درآمد</a></li>
</ul>
</div>
</div>

<div class="right_block">
<div class="right_block_top">
  <div class="right_block_top_text">آمار و اطلاعات</div>
</div>
<div class="right_block_content">
  <ul>
<li style="font-weight:bold;color:#06C">بخش درآمد</li>
<li>بازدید های امروز: <?php user_today_hit(); ?></li>
<li>بازدید های دیروز: <?php user_yesterday_hit(); ?></li>
<li>بازدید های کل: <?php user_total_hit(); ?></li>
<li style="font-weight:bold;color:#06C">بخش تبلیغات</li>
<li>سایت های فعال : <?php active_status(); ?></li>
<li>سایت های منتظر تایید : <?php wait_status(); ?>
</li>
<li>سایت های متوقف شده : <?php stop_status(); ?></li>
<li>کل مبلغ پرداختی : <?php user_pays(); ?> ریال</li>
<li>کل درآمد دریافتی : <?php user_earned(); ?> ریال</li>
</ul>

</div>
</div>

</div>
<?php } ?>