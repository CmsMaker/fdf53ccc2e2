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

	$funcPath = 
		$_SERVER[ 'DOCUMENT_ROOT' ] . DIRECTORY_SEPARATOR . "include" . DIRECTORY_SEPARATOR . "func.php";
	require_once( $funcPath );

 $db->sql_query ("SELECT * FROM `admin` WHERE `username`='".$_SESSION['admin']."'");
$data = $db->sql_fetcharray();


if(isset($_GET['id'])){
	
	$id = intval($_GET['id']);
	$type = $_GET['type'];
	
	$db->sql_query("SELECT * FROM `sites` WHERE `id`=$id");
$site_info = $db->sql_fetcharray();
$credit = $site_info['credit'];

$db->sql_query("SELECT * FROM `user` WHERE `username`='".$site_info['username']."'");
$user_info = $db->sql_fetcharray();
}

if(isset($_GET['action'])&&($_GET['action']) == "stop") {

$db->sql_query("UPDATE `sites` SET status='2' WHERE `id`=$id");
		header("Location: sites.php?type={$type}");
	
} elseif(isset($_GET['action'])&&($_GET['action']) == "delete") {
	
	$db->sql_query("UPDATE `user` SET `credit`=credit+$credit WHERE `username`='".$site_info['username']."'");

$db->sql_query("DELETE FROM `sites` WHERE `id`=$id");
		header("Location: sites.php?type={$type}");
	
}elseif(isset($_GET['action'])&&($_GET['action']) == "active") {

		$db->sql_query("UPDATE `sites` SET status='1' WHERE `id`=$id");
		
		$mysqli = getMySqlHandel();
		
		$r = $mysqli->query( "SELECT * FROM sites WHERE id=$id" );
		$r = $r->fetch_assoc();
		
		$_SESSION[ 'user' ] = $r[ 'username' ];
		
		sendSmsToUser( 6 );
		
		unset( $_SESSION[ 'user' ] );
		
		$subject = "سایت شما با موفقیت تایید شد.";
		$msg = "وبسایت شما با اطلاعات زیر در سامانه ما تایید شد:";
        include "data/admin/site_mail.php";
		
		
		header("Location: sites.php?type=$type");
		
}elseif(isset($_GET['action'])&&($_GET['action']) == "resume") {

$db->sql_query("UPDATE `sites` SET status='1' WHERE `id`=$id");
		header("Location: sites.php?type={$type}");
	
}elseif(isset($_GET['action'])&&($_GET['action']) == "inactive") {

$db->sql_query("UPDATE `sites` SET status='0' WHERE `id`=$id");
		header("Location: sites.php?type={$type}");
	
}



if($_GET['type'] == "active"){
		$site_status = "1";
		$site_type = "active";
	}
	elseif($_GET['type'] == "inactive"){
		$site_status = "0";
		$site_type = "inactive";
	}
	elseif($_GET['type'] == "stop"){
		$site_status = "2";
		$site_type = "stop";
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
$rsUsers = $db->sql_query("SELECT * FROM `sites` WHERE `status`='$site_status' LIMIT ".$limit);
$total = $db->sql_getrows("SELECT * FROM `sites` WHERE `status`='$site_status'");
}

$ex = "?";

$alpha = $_GET['sp'] + $max;
$pout .= "<div dir=\"ltr\"><center>";
if ($limitstart != 0) {
		$pout.= "<a title=\"&#1589;&#1601;&#1581;&#1607; &#1602;&#1576;&#1604;\" href=\"./sites.php".$ex."sp=".($limitstart - $max).$url."&type=".$site_type."\"><<</a>&nbsp;";
}else {
	$pout .= "<<&nbsp;";
}
	
$pg = 0; 
for ($i = (ceil($_GET['sp']/$max) - 3); $i <= (ceil($_GET['sp']/$max) + 5); $i++) {
if (($i > 0) && ($i <= ceil($total/$max))) { 
	if (!($_GET['sp'] == $pg)) { $link = "<a href=\"".$ex."sp=".$pg.$url."&type=".$site_type."\" title=\"&#1589;&#1601;&#1581;&#1607; ".$i."\">"; } else { $link = "<u>"; }
	if (($pg == 0) && !(isset($_GET['sp']))) { $link = ""; }
	$pout .= "<b>".$link.Num2Fa($i)."</a></u></b>&nbsp;";
	//$pg = $pg + $max;
	$pg = $i * $max;
}
}

if ($db->sql_getrows("SELECT * FROM `sites` WHERE `status`='$site_status'") > $alpha) {
		$pout .= "&nbsp;<a title=\"&#1589;&#1601;&#1581;&#1607; &#1576;&#1593;&#1583;\" href=\"./sites.php".$ex."sp=".($limitstart + $max).$url."&type=".$site_type."\">>></a>";
} else {
	$pout .= "&nbsp;>>";
}
$pout .= "</center></div>";

//End_pegination



?>
<?php include"header.php"; ?>
<script language="javascript">
	
	function active_site(id,type)
	{
		if(confirm("آیا می خواهید این سایت را فعال کنید؟"))
		{
			document.location.href="?action=active&id="+id+"&type="+type;
		}
	}
	
	function delete_site(id,type)
	{
		if(confirm("آیا می خواهید این سایت را حذف کنید؟"))
		{
			document.location.href="?action=delete&id="+id+"&type="+type;
		}
	}
	function stop_site(id,type)
	{
		if(confirm("آیا می خواهید این سایت را متوقف کنید؟"))
		{
			document.location.href="?action=stop&id="+id+"&type="+type;
		}
	}
	function resume_site(id,type)
	{
		if(confirm("آیا می خواهید بازدید گیری سایت را از سرگیری کنید؟"))
		{
			document.location.href="?action=resume&id="+id+"&type="+type;
		}
	}
	function inactive_site(id,type)
	{
		if(confirm("آیا می خواهید سایت را غیر فعال کنید؟"))
		{
			document.location.href="?action=inactive&id="+id+"&type="+type;
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
 <?php
if ( isset($_GET['type']) && ($_GET['type'] == "active" ||$_GET['type'] == "inactive" || $_GET['type'] == "stop"  )) {

	

?>
<table width="670px" style="font-size:12px;border:1px solid#999;margin-top:20px">
<tr style="background:#CCC;font-weight:bold;text-align:center;">
<td width="33">ID</td>
<td width="107">نام سایت</td>
<td width="49">نام کاربری</td>
<td width="81">سایت</td>
<td width="66">وضعیت</td>
<td width="186">عملیات</td>

</tr>
<?php
$db->sql_query("SELECT * FROM `sites` WHERE `status`=$site_status ORDER BY id DESC LIMIT $limit");

while($fetch=$db->sql_fetcharray()) {
	if($fetch['status'] == 0){
		$status = "<font color='red'>غیرفعال</font>";
	}
	elseif($fetch['status'] == 1){
		$status = "<font color='green'>فعال</font>";	
	}
	elseif($fetch['status'] == 2){
		$status = "<font color='red'>متوقف شده</font>";	
	}
		?>
<tr>

<td width="33" style="text-align:center"><?php echo $fetch['id']; ?></td>
<td width="107" style="text-align:center"><?php echo $fetch['title']; ?></td>
<td width="81" style="text-align:center"><?php echo $fetch['username']; ?></td>
<td width="49" style="text-align:center"><a href="<?php echo $fetch['url']; ?>">مشاهده</a></td>
<td width="66" style="text-align:center"><?php echo $status; ?></td>
<td width="186" style="text-align:center">
<a id="example1" href="pages/add_credit.php?id=<?php echo $fetch['id']; ?>" class="tooltip yellow-tooltip"><span>افزودن اعتبار</span><div class="icon-add"></div></a>
<a href="javascript:delete_site('<?php echo $fetch['id']; ?>','<?php echo $site_type; ?>')" class="tooltip yellow-tooltip"><span>حذف سایت</span><div class="icon-delete"></div></a>
<a id="example1" href="pages/edit_site.php?id=<?php echo $fetch['id']; ?>" class="tooltip yellow-tooltip"><span>ویرایش سایت</span><div class="icon-edit"></div></a>

<?php if($fetch['status'] == "0"){ ?>
<a href="javascript:active_site('<?php echo $fetch['id']; ?>','<?php echo $site_type; ?>')" class="tooltip yellow-tooltip"><span>فعال سازی</span><div class="icon-active"></div></a>
<?php } elseif($fetch['status'] == "1"){ ?>
<a href="javascript:inactive_site('<?php echo $fetch['id']; ?>','<?php echo $site_type; ?>')" class="tooltip yellow-tooltip"><span>غیرفعال سازی</span><div class="icon-inactive"></div></a>
<a href="javascript:stop_site('<?php echo $fetch['id']; ?>','<?php echo $site_type; ?>')" class="tooltip yellow-tooltip"><span>متوقف سازی</span><div class="icon-stop"></div></a>
<?php } elseif($fetch['status'] == "2"){ ?>
<a href="javascript:resume_site('<?php echo $fetch['id']; ?>','<?php echo $site_type; ?>')" class="tooltip yellow-tooltip"><span>از سر گیری</span><div class="icon-resume"></div></a>
<?php } ?>
<a id="example1" href="pages/site_statistic.php?id=<?php echo $fetch['id']; ?>" class="tooltip yellow-tooltip"><span>آمار سایت</span><div class="icon-stats"></div></a>
</td>
</tr>
<?php }  ?>

</table>
<?php echo $pout; ?>
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