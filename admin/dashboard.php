<?php
include "../config.php";
include "../include/jdf.php";
include "../include/mysql.class.php";
$db = new Mysql($host,$dbuname,$dbpass,$dbname,false); //create database object
$db->Database_Connect(); //connect to database

session_start();
if ( isset($_SESSION['admin']) ) {
if ( (isset($_GET['logout'])) && ($_GET['logout'] == "true") )
{
unset ($_SESSION['admin']);
header ("Location: ../index.php");
}

?>
<?php $db->sql_query ("SELECT * FROM `admin` WHERE `username`='".$_SESSION['admin']."'");
$data = $db->sql_fetcharray();

?>
<?php include"header.php"; ?>


<div class="middle">
<?php include"rsidebar.php"; ?>

<div class="post_box">
<div class="post_box_top">
  <div class="post_box_top_text">پیشخوان مدیریت سیستم</div>
</div>
<div class="post_box_content">
  
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
</div>
<?php include"footer.php"; ?>
</body>
</html>
<?php 
 
  }  else { header("Location: ../index.php"); } ?>