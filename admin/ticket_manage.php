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




//Begin_pagination_sent
$max = 20;
if (!isset($_GET['sp2']))
{
   $limit = '0 , ';
   $limitstart = 0;
}
else
{
   $limit = "".$_GET['sp2']." , ";
   $limitstart = $_GET['sp2'];
}


$limit .= $max;
if ((isset($_GET['sort'])) && !($_GET['sort'] == "")) {

} else {
$rsUsers = $db->sql_query("SELECT * FROM `ticket_admin` LIMIT ".$limit);
$total = $db->sql_getrows("SELECT * FROM `ticket_admin`");
}

$ex = "?";

$alpha = $_GET['sp2'] + $max;
$pout2 .= "<div dir=\"ltr\"><center>";
if ($limitstart != 0) {
		$pout2.= "<a title=\"&#1589;&#1601;&#1581;&#1607; &#1602;&#1576;&#1604;\" href=\"./ticket_manage.php".$ex."sp2=".($limitstart - $max).$url."#ShowcaseTab2\"><<</a>&nbsp;";
}else {
	$pout2 .= "<<&nbsp;";
}
	
$pg = 0; 
for ($i = (ceil($_GET['sp2']/$max) - 3); $i <= (ceil($_GET['sp2']/$max) + 5); $i++) {
if (($i > 0) && ($i <= ceil($total/$max))) { 
	if (!($_GET['sp2'] == $pg)) { $link = "<a href=\"".$ex."sp2=".$pg.$url."#ShowcaseTab2\" title=\"&#1589;&#1601;&#1581;&#1607; ".$i."\">"; } else { $link = "<u>"; }
	if (($pg == 0) && !(isset($_GET['sp2']))) { $link = ""; }
	$pout2 .= "<b>".$link.Num2Fa($i)."</a></u></b>&nbsp;";
	//$pg = $pg + $max;
	$pg = $i * $max;
}
}

if ($db->sql_getrows("SELECT * FROM `ticket_admin`") > $alpha) {
		$pout2 .= "&nbsp;<a title=\"&#1589;&#1601;&#1581;&#1607; &#1576;&#1593;&#1583;\" href=\"./sites.php".$ex."sp2=".($limitstart + $max).$url."#ShowcaseTab2\">>></a>";
} else {
	$pout2 .= "&nbsp;>>";
}
$pout2 .= "</center></div>";

//End_pegination_sent





//Begin_pagination_recieved
$max = 20;
if (!isset($_GET['sp']))
{
   $limit = '0 , ';
   $limitstart = 0;
}
else
{
   $limit = "".$_GET['sp']." , ";
   $limitstart = $_GET['sp'];
}


$limit .= $max;
if ((isset($_GET['sort'])) && !($_GET['sort'] == "")) {

} else {
$rsUsers = $db->sql_query("SELECT * FROM `ticket` LIMIT ".$limit);
$total = $db->sql_getrows("SELECT * FROM `ticket`");
}

$ex = "?";

$alpha = $_GET['sp'] + $max;
$pout1 .= "<div dir=\"ltr\"><center>";
if ($limitstart != 0) {
		$pout1.= "<a title=\"&#1589;&#1601;&#1581;&#1607; &#1602;&#1576;&#1604;\" href=\"./ticket_manage.php".$ex."sp=".($limitstart - $max).$url."\"><<</a>&nbsp;";
}else {
	$pout1 .= "<<&nbsp;";
}
	
$pg = 0; 
for ($i = (ceil($_GET['sp']/$max) - 3); $i <= (ceil($_GET['sp']/$max) + 5); $i++) {
if (($i > 0) && ($i <= ceil($total/$max))) { 
	if (!($_GET['sp'] == $pg)) { $link = "<a href=\"".$ex."sp=".$pg.$url."\" title=\"&#1589;&#1601;&#1581;&#1607; ".$i."\">"; } else { $link = "<u>"; }
	if (($pg == 0) && !(isset($_GET['sp']))) { $link = ""; }
	$pout1 .= "<b>".$link.Num2Fa($i)."</a></u></b>&nbsp;";
	//$pg = $pg + $max;
	$pg = $i * $max;
}
}

if ($db->sql_getrows("SELECT * FROM `ticket`") > $alpha) {
		$pout1 .= "&nbsp;<a title=\"&#1589;&#1601;&#1581;&#1607; &#1576;&#1593;&#1583;\" href=\"./ticket_manage.php".$ex."sp=".($limitstart + $max).$url."\">>></a>";
} else {
	$pout1 .= "&nbsp;>>";
}
$pout1 .= "</center></div>";

//End_pegination_recieved





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
  <div class="post_box_top_text">مدیریت تیکت های پشتیبانی</div>
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
<table width="675" style="font-size:12px;border:1px solid #999">
<tr style="background:#CCC;font-weight:bold">
<td width="74" style="text-align:center">شماره تیکت</td>
<td width="226" style="text-align:center">عنوان</td>
<td width="75" style="text-align:center">تاریخ</td>
<td width="146" style="text-align:center">کاربر</td>
<td width="105" style="text-align:center">وضعیت</td>
</tr>

<?php
$db->sql_query("SELECT * FROM `ticket` ORDER BY id DESC LIMIT $limit");

while($fetch=$db->sql_fetcharray()) {
	if($fetch['status'] == 0){
		$status = "<font color='red'>خوانده نشده</font>";
	}
	elseif($fetch['status'] == 1){
		$status = "<font color='green'>خوانده شده</font>";	
	}
		?>
<tr>
<td style="text-align:center"><?php echo $fetch['id']; ?></td>
<td style="text-align:center"><a href="javascript:get_message(<?php echo $fetch['id']; ?>)"><?php echo $fetch['title']; ?></a></td>
<td style="text-align:center"><?php echo $fetch['date']; ?></td>
<td style="text-align:center"><?php echo $fetch['username']; ?></td>
<td style="text-align:center"><?php echo $status; ?></td>

</tr>
<?php  }?>

</table>

<?php echo $pout1; ?>

</div>
<div id="ShowcaseTab2" class="Showcasetab2_content">
<table width="673" style="font-size:12px;border:1px solid #999">
<tr style="background:#CCC;font-weight:bold">
<td width="74" style="text-align:center">شماره تیکت</td>
<td width="226" style="text-align:center">عنوان</td>
<td width="75" style="text-align:center">تاریخ</td>
<td width="146" style="text-align:center">کاربر</td>
<td width="105" style="text-align:center">وضعیت</td>
</tr>

<?php
$db->sql_query("SELECT * FROM `ticket_admin` ORDER BY id DESC LIMIT $limit");

while($fetch=$db->sql_fetcharray()) {
	if($fetch['status'] == 0){
		$status = "<font color='red'>خوانده نشده</font>";
	}
	elseif($fetch['status'] == 1){
		$status = "<font color='green'>خوانده شده</font>";	
	}
	
	if($fetch['all_users'] == ""){
	 
	 	$ShowUser= "{$fetch['username']}";
} elseif($fetch['all_users'] == 1){
		$ShowUser = "<font color='blue'>ارسال شده به همه</font>";
		$status = "<font color='blue'>اطلاعیه عمومی</font>";	
	
	 
	}
		
		
		?>
<tr>
<td style="text-align:center"><?php echo $fetch['id']; ?></td>
<td style="text-align:center"><a href="javascript:get_sent_message(<?php echo $fetch['id']; ?>)"><?php echo $fetch['title']; ?></a></td>
<td style="text-align:center"><?php echo $fetch['date']; ?></td>
<td style="text-align:center"><?php echo $ShowUser ?></td>
<td style="text-align:center"><?php echo $status; ?></td>

</tr>
<?php  }?>

</table>
<?php echo $pout2; ?>
</div>
</div>
</div>
</div>
</div>
<?php include"footer.php"; ?>
</body>
</html>
<?php 
 
  }  else { header("Location: ../index.php"); } ?>