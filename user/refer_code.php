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
  <div class="post_box_top_text">کد زیرمجموعه گیری</div>
</div>
<div class="post_box_content">

<?php if($data['refering'] == "1"){?>
	
<p style="color:green;text-align:center;font-weight:bold;padding:20px 0 20px 0">امکان زیر مجموعه گیری شما فعال می باشد</p>

<p>کد عضوگیری منحصر به فرد شما : </p>
<br>
 
 <center>
 <b>
 <?php echo $link; ?>/?refer=<?php echo $_SESSION['user']; ?>
 </center>
 </b>

<?php } else {?>

<p style="color:red;text-align:center;font-weight:bold;padding:20px 0 20px 0">امکان زیر مجموعه گیری شما غیر فعال است. برای فعال سازی، <a href="refer_activate.php">کلیک نمائید.</a></p>

<?php } ?>

<p>کد عضوگیری منحصر به فرد شما : </p>
<br>
 
 <center>
 <b>
 <?php echo $link; ?>/?refer=<?php echo $_SESSION['user']; ?>
 </center>
 </b>  


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