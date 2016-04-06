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


<div class="middle">
<?php include"rsidebar.php"; ?>

<div class="post_box">
<div class="post_box_top">
  <div class="post_box_top_text">فعال سازی زیر مجموعه گیری</div>
</div>
<div class="post_box_content">

<?php if($data['refering'] == "1"){?>
	
<p style="color:green;text-align:center;font-weight:bold;padding:20px 0 20px 0">امکان زیر مجموعه گیری شما فعال می باشد</p>

<?php } else {?>

<p style="color:red;text-align:center;font-weight:bold;padding:20px 0 20px 0">امکان زیر مجموعه گیری شما غیر فعال است.</p>

<?php } ?>

  <p>
  برای فعال سازی امکان زیر مجموعه گیری بایستی مبلغ <?php echo $refering_activation; ?> ریال را واریز نمائید .
  بعد از فعالسازی این امکان، برای همیشه میتوانید زیر مجموعه گیری نمائید.<p style="padding-top:20px;">  
  <?php if($data['refering'] == "0"){?>
  
  <a href="refer_payment.php" target="_blank"><div class="view_button">فعالسازی زیرمجموعه گیری</div></a>
  
  <?php } ?>
</div
></div>
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