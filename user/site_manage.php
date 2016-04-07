<?php
include "../config.php";
include "../include/jdf.php";
include "../include/mysql.class.php";
$db = new Mysql($host,$dbuname,$dbpass,$dbname,false); //create database object
$db->Database_Connect(); //connect to database

	# new Code ( SMS )
	
	$funcPath = 
		$_SERVER[ 'DOCUMENT_ROOT' ] . DIRECTORY_SEPARATOR . "include" . DIRECTORY_SEPARATOR . "func.php";
	require_once( $funcPath );
	
	# End
	
	

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
	
	
if(isset($_GET['id'])) {
	
	$id = intval( $_GET['id'] );
	
	
	$db->sql_query("SELECT * FROM `sites` WHERE `id`=$id AND `username`='".$_SESSION['user']."'");
	$site = $db->sql_fetcharray();

	$credit = $site['credit'];
}	
	
if(isset($_GET['action'])&&($_GET['action']) == "delete") {
	
$db->sql_query("UPDATE `user` SET `credit`=credit+$credit WHERE `username`='".$_SESSION['user']."'");

	$db->sql_query("DELETE FROM `sites` WHERE `id`=$id AND `username`='".$_SESSION['user']."'");
	
	sendSmsToUser( 5 );
	
	header("Location: site_manage.php");
	
}

elseif(isset($_GET['action'])&&($_GET['action']) == "stop") {
	
	if($site['status'] == 1){
		
		

$db->sql_query("UPDATE `sites` SET status='2' WHERE `id`=$id");
		header("Location: site_manage.php");
	}
	else{
	header("Location: site_manage.php");
	
	}
}

elseif(isset($_GET['action'])&&($_GET['action']) == "resume") {
	
	if($site['status'] == 2){
		
		

$db->sql_query("UPDATE `sites` SET status='1' WHERE `id`=$id");
		header("Location: site_manage.php");
	}
	else{
	header("Location: site_manage.php");
	
	}
}
?>
<?php include"header.php"; ?>
<script language="javascript">
	
	function delete_site(id)
	{
		if(confirm("آیا می خواهید این سایت را حذف کنید؟"))
		{
			document.location.href="?action=delete&id="+id;
		}
	}
	function stop_site(id)
	{
		if(confirm("آیا می خواهید این سایت را متوقف کنید؟"))
		{
			document.location.href="?action=stop&id="+id;
		}
	}
	function resume_site(id)
	{
		if(confirm("آیا می خواهید بازدیدگیری سایت را فعال کنید؟"))
		{
			document.location.href="?action=resume&id="+id;
		}
	}
	</script>

<div class="middle">
<?php include"rsidebar.php"; ?>

<div class="post_box">
<div class="post_box_top">
  <div class="post_box_top_text">مدیریت سایت ها</div>
</div>
<div class="post_box_content">
تشریح وضعیت سایت:
<br />
1- منتظر تایید: شما تازه سایت رو اضافه کردید و مدیریت بعد از بررسی سایت، فعالش خواهد کرد.
<br />
2- فعال: سایت شما در صورتی که اعتبار کافی برای بازدید داشته باشید، برای کاربران نمایش داده می شود.
<br />
3- متوقف شده : این وضعیت توسط شما اعمال می گردد و در صورتی که تشخیص میدهید فعلا نیازی به بازدید ندارید، می توانید این وضعیت را از بخش عملیات آن سایت اعمال نمائید.
<br />
<table width="675" style="font-size:12px;border:1px solid#999;margin-top:15px">
<tr style="background:#CCC;font-weight:bold;text-align:center">
<td width="35">ID</td>
<td width="159">عنوان سایت</td>
<td width="70">آدرس</td>
<td width="119">بازدید باقیمانده</td>
<td width="101">وضعیت</td>
<td width="158">عملیات</td>

</tr>
<?php
$db->sql_query("SELECT * FROM `sites` WHERE `username`='".$_SESSION['user']."' ORDER BY id DESC LIMIT 20");

while($fetch=$db->sql_fetcharray()) {
	if($fetch['status'] == 0){
		$status = "<font color='red'>منتظر تایید</font>";
	}
	elseif($fetch['status'] == 1){
		$status = "<font color='green'>فعال</font>";	
	}
	elseif($fetch['status'] == 2){
		$status = "<font color='red'>متوقف شده</font>";	
	}
	
		?>
<tr>

<td width="35" style="text-align:center"><?php echo $fetch['id']; ?></td>
<td width="159" style="text-align:center"><?php echo $fetch['title']; ?></td>
<td width="70" style="text-align:center"><a href="<?php echo $fetch['url']; ?>">مشاهده</a></td>
<td width="119" style="text-align:center"><?php echo $fetch['credit']; ?></td>
<td width="101" style="text-align:center"><?php echo $status; ?></td>
<td width="158" style="text-align:center">
<a id="example1" href="pages/user_add_credit.php?id=<?php echo $fetch['id']; ?>" class="tooltip yellow-tooltip"><span>افزودن بازدید</span><div class="icon-add"></div></a>
<a href="javascript:delete_site('<?php echo $fetch['id']; ?>')" class="tooltip yellow-tooltip"><span>حذف سایت</span><div class="icon-delete"></div></a>
<a id="example1" href="pages/user_edit_site.php?id=<?php echo $fetch['id']; ?>" class="tooltip yellow-tooltip"><span>ویرایش سایت</span><div class="icon-edit"></div></a>
<?php
		if($fetch['status'] == 1){
			
	
echo"<a href=\"javascript:stop_site('".$fetch['id']."')\" class=\"tooltip yellow-tooltip\"><span>متوقف کردن</span><div class=\"icon-stop\"></div></a>
<a  id=\"example1\" href=\"pages/site_statistic.php?id=".$fetch['id']."\" class=\"tooltip yellow-tooltip\"><span>آمار سایت</span><div class=\"icon-stats\"></div></a>

";
 } elseif($fetch['status'] == 2){
			
	
echo"<a href=\"javascript:resume_site('".$fetch['id']."')\" class=\"tooltip yellow-tooltip\"><span>از سرگیری بازدید</span><div class=\"icon-resume\"></div></a>";
 } ?>
</td>
</tr>
<?php }
?>

</table>

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