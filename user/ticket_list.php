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

?>
<?php $db->sql_query ("SELECT * FROM `user` WHERE `username`='".$_SESSION['user']."'");
$data = $db->sql_fetcharray();

if($data['status'] == "1")
{
?>
<?php include"header.php"; ?>

<script language="javascript" type="text/javascript">
	$(function () {
		$(".Showcasetab2_content").hide();
		$("div.tabsShowcase2 a:first").addClass("ShowcaseActive").show();
		$(".Showcasetab2_content:first").show();
		$("div.tabsShowcase2 a").click(function () {
			$("div.tabsShowcase2 a").removeClass("ShowcaseActive");
			$(this).addClass("ShowcaseActive");
			$(".Showcasetab2_content").hide();
			var activeTab = $(this).attr("href");
			$(activeTab).fadeIn();
			return false;
		});
	});
</script>
<div class="middle">
<?php include"rsidebar.php"; ?>

<div class="post_box">
<div class="post_box_top">
  <div class="post_box_top_text">تیکت های پشتیبانی</div>
</div>
<div class="post_box_content">

<center>
<div class="tabsShowcase2">
<a href="#ShowcaseTab1">تیکت های دریافتی</a>
<a href="#ShowcaseTab2">تیکت های ارسالی</a>
</div>
</center>
<div align="center" style="margin-top:30px" id="message"></div>
<div id="ShowcaseTab1" class="Showcasetab2_content">
<table width="668" style="font-size:12px;border:1px solid #999">
<tr style="background:#CCC;font-weight:bold">
<td width="74" style="text-align:center">شماره تیکت</td>
<td width="271" style="text-align:center">عنوان</td>
<td width="110" style="text-align:center">تاریخ</td>
<td width="193" style="text-align:center">وضعیت</td>
</tr>

<?php
$db->sql_query("SELECT * FROM `ticket_admin` WHERE `username`='".$_SESSION['user']."' OR `all_users`='1' ORDER BY id DESC LIMIT 10");

while($fetch=$db->sql_fetcharray()) {
	if($fetch['all_users'] == 1){
		$status = "<font color='blue'>اطلاعیه عمومی</font>";	}
	elseif($fetch['status'] == 0){
		$status = "<font color='red'>خوانده نشده توسط شما</font>";
	}
	elseif($fetch['status'] == 1){
		$status = "<font color='green'>خوانده شده توسط شما</font>";	
	}
		?>
<tr>
<td style="text-align:center"><?php echo $fetch['id']; ?></td>
<td style="text-align:center"><a href="javascript:get_message(<?php echo $fetch['id']; ?>)"><?php echo $fetch['title']; ?></a></td>
<td style="text-align:center"><?php echo $fetch['date']; ?></td>
<td style="text-align:center"><?php echo $status; ?></td>

</tr>
<?php } ?>

</table></div>
<div id="ShowcaseTab2" class="Showcasetab2_content">
<table width="669" style="font-size:12px;border:1px solid #999">
<tr style="background:#CCC;font-weight:bold">
<td width="74" style="text-align:center">شماره تیکت</td>
<td width="271" style="text-align:center">عنوان</td>
<td width="110" style="text-align:center">تاریخ</td>
<td width="194" style="text-align:center">وضعیت</td>
</tr>

<?php
$db->sql_query("SELECT * FROM `ticket` WHERE `username`='".$_SESSION['user']."' ORDER BY id DESC LIMIT 10");

while($fetch=$db->sql_fetcharray()) {
	if($fetch['status'] == 0){
		$status = "<font color='red'>در حال رسیدگی</font>";
	}
	elseif($fetch['status'] == 1){
		$status = "<font color='green'>خوانده شده</font>";	
	}
		?>
<tr>
<td style="text-align:center"><?php echo $fetch['id']; ?></td>
<td style="text-align:center"><a href="javascript:get_sent_message(<?php echo $fetch['id']; ?>)"><?php echo $fetch['title']; ?></a></td>
<td style="text-align:center"><?php echo $fetch['date']; ?></td>
<td style="text-align:center"><?php echo $status; ?></td>

</tr>
<?php } ?>

</table></div>


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