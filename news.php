<?php
include "config.php";
include "include/mysql.class.php";
$db = new Mysql($host,$dbuname,$dbpass,$dbname,false);
$db->Database_Connect();
$id = $_GET['id'];
$db->sql_query("SELECT * FROM `news` WHERE `id`=$id");
$fetch = $db->sql_fetcharray();
$db->sql_query("UPDATE `news` SET view=view+1 WHERE `id`='".$fetch['id']."'");
?>
<div class="news_info" style="width:450px" dir="rtl">
<div class="news_title" style="width:450px;font-family:tahoma;font-size:12px;font-weight:bold;color:#C00;direction:rtl" ><?php echo $fetch['title']; ?></div> 
<div class="news_date" style="color:#00F">
 تاریخ : <font
 dir="ltr"><?php echo $fetch['date']; ?></font>
</div>
<br />
<div class="news_title" style="width:450px;font-family:tahoma;font-size:12px;direction:rtl" ><?php echo $fetch['text']; ?>
<br />
</div>
</div>