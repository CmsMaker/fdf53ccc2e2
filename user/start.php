<?php
include "../config.php";
include "../include/jdf.php";
include "../include/mysql.class.php";
$db = new Mysql($host,$dbuname,$dbpass,$dbname,false); //create database object
$db->Database_Connect(); //connect to database

session_start();
if ( isset($_SESSION['user']) ) {
if ( (isset($_GET['logout'])) && ($_GET['logout'] == "true") )
{
unset ($_SESSION['user']);
header ("Location: ../index.php");
}

$db->sql_query ("SELECT * FROM `user` WHERE `username`='".$_SESSION['user']."'");
$data = $db->sql_fetcharray();
if($data['status'] == "1")
{
	
	//Create Security ID
	$sec_id = rand(1111111,9999999);
	$ip = $_SERVER['REMOTE_ADDR'];
	
	
	
	if(isset($_GET['action']) && $_GET['action'] == "repent"){
		
	$db->sql_query("DELETE FROM `sec_info` WHERE `ip`='".$ip."'");
		header("Location: start.php");
	}
	
	if(isset($_GET['action']) && $_GET['action'] == "repent2"){
		
	$db->sql_query("DELETE FROM `site_sec_info` WHERE `ip`='".$ip."'");
		header("Location: start.php");
	}
	
	
	
	
	if($db->sql_getrows("SELECT * FROM `sec_info` WHERE `username`='".$_SESSION['user']."'") > 0){
		
		$db->sql_query("DELETE FROM `sec_info` WHERE `username`='".$_SESSION['user']."'");
		$db->sql_query("INSERT INTO `sec_info` (sec_id,username,status,ip) VALUES ('$sec_id','".$_SESSION['user']."','0','$ip')");	
	}
	else{
	$db->sql_query("INSERT INTO `sec_info` (sec_id,username,status,ip) VALUES ('$sec_id','".$_SESSION['user']."','0','$ip')");	
	}
?>
<?php include"header.php"; ?>


<div class="middle">
<?php include"rsidebar.php"; ?>

<div class="post_box">
<div class="post_box_top">
  <div class="post_box_top_text">کسب درآمد</div>
</div>
<div class="post_box_content">
  <p><br>
    <font style="font-size:16px;font-family:ST;color:#F00;padding-top:15px">قبل از شروع به کسب درآمد به نکات زیر توجه نمائید:</font>
  <br>
  <br />
  <font style="font-size:16px;font-family:ST;color:#009;padding-top:15px">
    1- صفحه قوانین، بخش کسب درآمد را مطالعه نمائید.
  <br />
  <br />
  2- فقط از مرورگر فایرفاکس استفاده نمائید چون در مرورگر های دیگر مثل گوگل کروم باز شدن پاپ آپ ها شما را اذیت خواهد کرد.
  </font></p>
  <p>&nbsp;</p>
  <p><font style="font-size:16px;font-family:ST;color:#009;padding-top:15px">3- حتما امکان باز شدن پاپ آپ را در مرورگر فایرفاکس خود فعال کنید در غیر اینصورت درآمد و بازدید شما ثبت نخواهد شد.<br />
    <br />
    4- به موارد زیر دقت نمائید:
  </font></p>
  <p>الف) شما نیازی نیست بعد از شروع به کسب درآمد پشت سیستم خود باشید و سیستم به صورت خودکار عملیات لازم را انجام میدهد ولی هر از چند گاهی به صفحه کسب درآمد مراجعه کنید تا در صورت قطع احتمالی بازدیدگیری ، در جریان قطعی قرار گیرید و کسب درآمد را از سر گیری نمائید.</p>
  <p>ب) بعد از کلیک بر روی گزینه &quot;شروع کسب درآمد&quot; مجددا به این صفحه مراجعه نکنید. در غیر این صورت کسب درآمد شما به صورت خودکار متوقف خواهد شد.</p>
  <?php if($db->sql_getrows("SELECT * FROM `sec_info` WHERE `ip`='".$ip."'") > 1){ ?>
  <p>
  <a href="start.php?action=repent">
  <div class="view_button" style="margin-bottom:15px" >نادیده گرفتن تقلب</div></a></p>
  
  <?php } ?>
   <p>
   
    <?php if($db->sql_getrows("SELECT * FROM `site_sec_info` WHERE `ip`='".$ip."'") > 1){ ?>
  <p>
  <a href="start.php?action=repent2">
  <div class="view_button" style="margin-bottom:15px" >نادیده گرفتن تقلب</div></a></p>
  
  <?php } ?>
   <p>
 
  <a href="a_surf.php?sec_id=<?php echo $sec_id; ?>" target="_blank"><div class="view_button">شروع کسب درآمد</div></a></p>
</div>
</div>
</div>
</div>
<?php include"footer.php"; ?>


</body>
</html>
<?php }
elseif($data['status'] == "0")
{
	include "activate.php";

 }
 elseif($data['status'] == "2")
{
	include "blocked.php";

 }
 
  }  else { header("Location: ../index.php"); } ?>