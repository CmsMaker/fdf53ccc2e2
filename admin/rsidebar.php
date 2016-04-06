<?php 
if ( isset($_SESSION['admin']) ) {

?>
<div class="right">

<div class="right_block">
<div class="right_block_top">
  <div class="right_block_top_text">منوی مدیریت</div>
</div>
<div class="right_block_content">
<ul>
<li><a href="dashboard.php">پیشخوان مدیریت</a></li>
<li style="font-weight:bold;color:#06C">مدیریت سایت</li>
<li><a href="site_settings.php">تنظیمات سایت</a></li>
<li><a href="email_settings.php">تنظیمات ایمیل</a></li>
<li><a href="change_pass.php">تغییر کلمه عبور</a></li>
<li style="font-weight:bold"><a href="?logout=true">خروج از مدیریت</a></li>
<li style="font-weight:bold;color:#06C">مدیریت کاربران</li>
<li><a href="user_manage_active.php">کاربران فعال</a></li>
<li><a href="user_manage_inactive.php">کاربران غیرفعال</a></li>
<li><a href="user_manage_block.php">کاربران اخراج شده</a></li>
<li style="font-weight:bold;color:#06C">مدیریت سایت ها</li>
<li><a href="sites.php?type=active">سایت های تایید شده</a></li>
<li><a href="sites.php?type=inactive">سایت های تایید نشده (<?php wait_status() ?>)</a></li>
<li><a href="sites.php?type=stop">سایت های متوقف شده (<?php stop_status() ?>)</a></li>
<li style="font-weight:bold;color:#06C">پشتیبانی و خبرنامه</li>
<li><a href="ticket_send.php">ارسال تیکت</a></li>
<li><a href="ticket_manage.php">مدیریت تیکت ها (<?php unread_ticket() ?>)</a></li>
<li style="font-weight:bold;color:#06C">اخبار و صفحات</li>
<li><a href="news_add.php">افزودن خبر جدید</a></li>
<li><a href="news_manage.php">مدیریت اخبار</a></li>
<li><a href="faq_add.php">افزودن سوال متداول</a></li>
<li><a href="faq_manage.php">مدیریت سوالات متداول</a></li>
<li><a href="contact_rule_page.php">صفحات تماس با ما و قوانین</a></li>
<li style="font-weight:bold;color:#06C">مدیریت مالی</li>
<li><a href="pays_list.php">لیست پرداخت ها</a></li>
<li><a href="users_request.php">درخواست واریز کاربران (<?php user_request() ?>)</a></li>
<li><a href="users_fish.php">ثبت فیش واریزی</a></li>
<li><a href="fish_list.php">لیست فیش ها</a></li>
<li><a href="add_credit.php">شارژ اعتبار کاربران</a></li>
<li><a href="tariff_manage.php">مدیریت تعرفه های پرداخت آنلاین</a></li>
<li><a href="bank_manage.php">مدیریت نام بانک ها</a></li>
</ul>
</div>
</div>

<div class="right_block">
<div class="right_block_top">
  <div class="right_block_top_text">آمار و اطلاعات</div>
</div>
<div class="right_block_content">
  <ul>
<li style="font-weight:bold;color:#06C">کاربران</li>
<li>تعداد کل کاربران : <?php all_users(); ?></li>
<li>تعداد کاربران فعال : <?php active_users(); ?></li>
<li>تعداد کاربران غیر فعال : <?php inactive_users(); ?></li>
<li>تعداد کاربران اخراج شده : <?php blocked_users(); ?></li>
<li style="font-weight:bold;color:#06C">وبسایت ها</li>
<li>تعداد کل سایت ها : <?php all_sites(); ?></li>
<li>تعداد سایت های فعال : <?php active_status(); ?></li>
<li>تعداد سایت های منتظر تایید : <?php wait_status(); ?></li>
<li>تعداد سایت های متوقف شده : <?php stop_status(); ?></li>
<li style="font-weight:bold;color:#06C">امور مالی</li>
<li>مبلغ کل دریافتی : <?php all_earned(); ?> ریال</li>
<li>مبلغ کل پرداختی : <?php all_pays(); ?> ریال</li>
<li style="font-weight:bold;color:#06C">بازدید ها</li>
<li>بازدید های امروز : <?php today_hit(); ?></li>
<li>بازدید های دیروز : <?php yesterday_hit(); ?></li>
<li>بازدید های کل : <?php total_hit(); ?></li>
<li>کاربران آنلاین : <?php online_users(); ?></li>
</ul>

</div>
</div>

</div>
<?php } ?>