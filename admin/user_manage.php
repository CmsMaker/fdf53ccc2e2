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



if(isset($_GET['action']) == "delete" && $_GET['id'] && ($_GET['id']) !== "") {
	$id = $_GET['id'];
	$page_type = $_GET['type'];

	if($db->sql_query("DELETE FROM `user` WHERE `id`='$id'")) {
		header("Location: user_manage.php?type=$page_type");
	}
}

if(isset($_GET['action']) == "block" && $_GET['id'] && ($_GET['id']) !== "") {
	$id = $_GET['id'];
	$page_type = $_GET['type'];

	if($db->sql_query("UPDATE `user` SET status='2' WHERE `id`=$id")) {
		header("Location: user_manage.php?type=$page_type");
	}
}
?>
<?php include"header.php"; ?>
<script language="javascript">
	
	function delete_user(id,sp)
	{
		if(confirm("آیا می خواهید این کاربر را حذف کنید؟"))
		{
			document.location.href="?action=delete&id="+id+"&redirect="+sp;
		}
	}
	
	function block_user(id,sp)
	{
		if(confirm("آیا می خواهید این کاربر رااخراج کنید؟"))
		{
			document.location.href="?action=block&id="+id+"&redirect="+sp;
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
<?php
if ( isset($_GET['type']) && ($_GET['type'] == "active" ||$_GET['type'] == "inactive" || $_GET['type'] == "blocked"  )) {
	if($_GET['type'] == "active"){
		$user_status = "1";
	}
	if($_GET['type'] == "inactive"){
		$user_status = "0";
	}
	if($_GET['type'] == "blocked"){
		$user_status = "2";
	}

?>
<table width="670px" style="font-size:12px;border:1px solid#999;margin-top:20px">
<tr style="background:#CCC;font-weight:bold;text-align:center;">
<td width="33">ID</td>
<td width="107">نام و نام خانوادگی</td>
<td width="49">ایمیل</td>
<td width="81">موبایل</td>
<td width="66">وضعیت</td>
<td width="186">عملیات</td>

</tr>
<?php
$db->sql_query("SELECT * FROM `user` WHERE `status`=$user_status ORDER BY id DESC LIMIT 20");

while($fetch=$db->sql_fetcharray()) {
	if($fetch['status'] == 0){
		$status = "<font color='red'>غیرفعال</font>";
	}
	elseif($fetch['status'] == 1){
		$status = "<font color='green'>فعال</font>";	
	}
	elseif($fetch['status'] == 2){
		$status = "<font color='red'>اخراج شده</font>";	
	}
		?>
<tr>

<td width="33" style="text-align:center"><?php echo $fetch['id']; ?></td>
<td width="107" style="text-align:center"><?php echo $fetch['name']; ?></td>
<td width="49" style="text-align:center"><a href="mailto:<?php echo $fetch['email']; ?>">مشاهده</a></td>
<td width="81" style="text-align:center"><?php echo $fetch['mobile']; ?></td>
<td width="66" style="text-align:center"><?php echo $status; ?></td>
<td width="186" style="text-align:center">
<a id="example1" href="data/user_add_credit_form.php?id=<?php echo $fetch['id']; ?>" class="tooltip yellow-tooltip"><span>افزودن اعتبار</span><div class="icon-add"></div></a>
<a href="1" class="tooltip yellow-tooltip"><span>حذف کاربر</span><div class="icon-delete"></div></a>
<a href="1" class="tooltip yellow-tooltip"><span>ویرایش کاربر</span><div class="icon-edit"></div></a>
<a href="javascript:block_user('<?php echo $fetch['id']; ?>','')" class="tooltip yellow-tooltip"><span>مسدود کردن کاربر</span><div class="icon-stop"></div></a>
</td>
</tr>
<?php }  ?>

</table>
<?php }  else {
	echo "<p style=\"text-align:center;padding-top:20px;font-family:ST;font-size:17px;color:red\">درخواست غیرمجاز می باشد.</p>";
	
	} ?>
</div>
</div>
</div>
</div>
<?php include"footer.php"; ?>
</body>
</html>
<?php 
 
  }  else { header("Location: ../index.php"); } ?>