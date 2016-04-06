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
if(isset($_GET['id'])){
	
	$id = $_GET['id'];
}
if(isset($_GET['action'])&&($_GET['action']) == "delete") {

$db->sql_query("DELETE FROM `request` WHERE `id`=$id");
		header("Location: users_request.php");
	
}

 $db->sql_query ("SELECT * FROM `admin` WHERE `username`='".$_SESSION['admin']."'");
$data = $db->sql_fetcharray();



//Begin_pagination
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


$ex = "?";

$alpha = $_GET['sp'] + $max;
$pout .= "<div dir=\"ltr\"><center>";
if ($limitstart != 0) {
		$pout.= "<a title=\"&#1589;&#1601;&#1581;&#1607; &#1602;&#1576;&#1604;\" href=\"./users_request.php".$ex."sp=".($limitstart - $max).$url."\"><<</a>&nbsp;";
}else {
	$pout .= "<<&nbsp;";
}
	
$pg = 0; 
for ($i = (ceil($_GET['sp']/$max) - 3); $i <= (ceil($_GET['sp']/$max) + 5); $i++) {
if (($i > 0) && ($i <= ceil($total/$max))) { 
	if (!($_GET['sp'] == $pg)) { $link = "<a href=\"".$ex."sp=".$pg.$url."\" title=\"&#1589;&#1601;&#1581;&#1607; ".$i."\">"; } else { $link = "<u>"; }
	if (($pg == 0) && !(isset($_GET['sp']))) { $link = ""; }
	$pout .= "<b>".$link.Num2Fa($i)."</a></u></b>&nbsp;";
	//$pg = $pg + $max;
	$pg = $i * $max;
}
}

if ($db->sql_getrows("SELECT * FROM `request`") > $alpha) {
		$pout .= "&nbsp;<a title=\"&#1589;&#1601;&#1581;&#1607; &#1576;&#1593;&#1583;\" href=\"./users_request.php".$ex."sp=".($limitstart + $max).$url."\">>></a>";
} else {
	$pout .= "&nbsp;>>";
}
$pout .= "</center></div>";

//End_pegination





?>
<?php include"header.php"; ?>
<script language="javascript">
	
	function del_request(id)
	{
		if(confirm("آیا می خواهید این درخواست را حذف کنید؟"))
		{
			document.location.href="?action=delete&id="+id;
		}
		else
		{}
	}
</script>

<div class="middle">
<?php include"rsidebar.php"; ?>

<div class="post_box">
<div class="post_box_top">
  <div class="post_box_top_text">درخواست های واریزی کاربران</div>
</div>
<div class="post_box_content">
  <table width="497" style="font-size:12px;border:1px solid#999;margin-top:20px" align="center">
<tr style="background:#CCC;font-weight:bold;text-align:center;">
<td width="59">ID</td>
<td width="232">مبلغ درخواستی</td>
<td width="280">نام کاربری</td>
<td width="79">عملیات</td>

</tr>
<?php

$db->sql_query("SELECT * FROM `request` ORDER BY `id` DESC LIMIT $limit");

while($fetch=$db->sql_fetcharray()) {
	$username = $fetch['username'];
	
	$user = mysql_query ("SELECT * FROM `user` WHERE `username`='".$username."'");
	$user_info= mysql_fetch_array($user)
		?>
<tr>

<td width="59" style="text-align:center"><?php echo $fetch['id']; ?></td>
<td width="232" style="text-align:center"><?php echo $fetch['amount']; ?> تومان</td>
<td width="280" style="text-align:center"><?php echo $fetch['username']; ?></td>
<td width="79" style="text-align:center">
<a id="example1" href="pages/user_info.php?id=<?php echo $user_info['id']; ?>" class="tooltip yellow-tooltip"><span>اطلاعات کاربر</span><div class="icon-info"></div></a>
<a href="javascript:del_request('<?php echo $fetch['id']; ?>')" class="tooltip yellow-tooltip"><span>حذف درخواست</span><div class="icon-delete"></div></a>
</td>
</tr>
<?php }  ?>

</table>
<?php echo $pout; ?>
</div>
</div>
</div>
</div>
<?php include"footer.php"; ?>
</body>
</html>
<?php 
 
  }  else { header("Location: ../index.php"); } ?>