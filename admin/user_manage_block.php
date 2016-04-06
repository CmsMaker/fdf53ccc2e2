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


if(isset($_GET['id'])){
	
	$id = $_GET['id'];
}
if(isset($_GET['action'])&&($_GET['action']) == "active") {

$db->sql_query("UPDATE `user` SET status='1' WHERE `id`=$id");
		header("Location: user_manage_block.php");
	
} elseif(isset($_GET['action'])&&($_GET['action']) == "delete") {

$db->sql_query("DELETE FROM `user` WHERE `id`=$id");
		header("Location: user_manage_block.php");
	
}



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
if ((isset($_GET['sort'])) && !($_GET['sort'] == "")) {

} else {
$rsUsers = $db->sql_query("SELECT * FROM `user` WHERE `status`='2' LIMIT ".$limit);
$total = $db->sql_getrows("SELECT * FROM `user` WHERE `status`='2'");
}

$ex = "?";

$alpha = $_GET['sp'] + $max;
$pout .= "<div dir=\"ltr\"><center>";
if ($limitstart != 0) {
		$pout.= "<a title=\"&#1589;&#1601;&#1581;&#1607; &#1602;&#1576;&#1604;\" href=\"./user_manage_block.php".$ex."sp=".($limitstart - $max).$url."\"><<</a>&nbsp;";
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

if ($db->sql_getrows("SELECT * FROM `user` WHERE `status`='2'") > $alpha) {
		$pout .= "&nbsp;<a title=\"&#1589;&#1601;&#1581;&#1607; &#1576;&#1593;&#1583;\" href=\"./user_manage_block.php".$ex."sp=".($limitstart + $max).$url."\">>></a>";
} else {
	$pout .= "&nbsp;>>";
}
$pout .= "</center></div>";

//End_pegination
?>
<?php include"header.php"; ?>
<script language="javascript">
	
	function delete_user(id,sp)
	{
		if(confirm("آیا می خواهید این کاربر را حذف کنید؟"))
		{
			document.location.href="?action=delete&id="+id;
		}
	}
	
	function active_user(id,sp)
	{
		if(confirm("آیا می خواهید این کاربر را فعال کنید؟"))
		{
			document.location.href="?action=active&id="+id;
		}
	}
</script>

<div class="middle">
<?php include"rsidebar.php"; ?>

<div class="post_box">
<div class="post_box_top">
  <div class="post_box_top_text">مدیریت کاربران</div>
</div>
<div class="post_box_content">

<table width="670px" style="font-size:12px;border:1px solid#999;margin-top:20px">
<tr style="background:#CCC;font-weight:bold;text-align:center;">
<td width="31">ID</td>
<td width="154">نام و نام خانوادگی</td>
<td width="95">نام کاربری</td>
<td width="67">ایمیل</td>
<td width="105">موبایل</td>
<td width="71">وضعیت</td>
<td width="115">عملیات</td>

</tr>
<?php
$db->sql_query("SELECT * FROM `user` WHERE `status`=2 ORDER BY id DESC LIMIT $limit");

while($fetch=$db->sql_fetcharray()) {
	if($fetch['status'] == 2){
		$status = "<font color='red'>اخراج شده</font>";
	}
		?>
<tr>

<td width="31" style="text-align:center"><?php echo $fetch['id']; ?></td>
<td width="154" style="text-align:center"><?php echo $fetch['name']; ?></td>
<td width="95" style="text-align:center"><?php echo $fetch['username']; ?></td>
<td width="67" style="text-align:center"><a href="mailto:<?php echo $fetch['email']; ?>">مشاهده</a></td>
<td width="105" style="text-align:center"><?php echo $fetch['mobile']; ?></td>
<td width="71" style="text-align:center"><?php echo $status; ?></td>
<td width="115" style="text-align:center">
<a href="javascript:delete_user('<?php echo $fetch['id']; ?>')" class="tooltip yellow-tooltip"><span>حذف کاربر</span><div class="icon-delete"></div></a>
<a id="example1" href="pages/edit_user.php?id=<?php echo $fetch['id']; ?>" class="tooltip yellow-tooltip"><span>ویرایش کاربر</span><div class="icon-edit"></div></a>
<a href="javascript:active_user('<?php echo $fetch['id']; ?>')" class="tooltip yellow-tooltip"><span>فعال کردن کاربر</span><div class="icon-active"></div></a>
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