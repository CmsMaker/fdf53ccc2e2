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


$db->sql_query ("SELECT * FROM `mail_reg`");
$email = $db->sql_fetcharray();

$db->sql_query ("SELECT * FROM `admin` WHERE `username`='".$_SESSION['admin']."'");
$data = $db->sql_fetcharray();




?>
<?php include"header.php"; ?>


<div class="middle">
<?php include"rsidebar.php"; ?>

<div class="post_box">
<div class="post_box_top">
  <div class="post_box_top_text">تنظیمات ایمیل</div>
</div>
<div class="post_box_content">
<table>
 <tr>
    	<td width="680" align="center" id="email_main"></td>
    </tr>
    </table>
<table border="0" cellspacing="15">
  <tr> <font style="font-family:ST;font-size:16px;color:#F00"> تنظیمات ایمیل : </font> </tr>
    <td width="204" style="font-size:12px" align="right">آدرس ایمیل فرستنده :</td>
    <td width="423" style="font-size:12px" align="right"><input name="email" type="text" id="email" size="30" style="font-family:tahoma;font-size:12px"  value="<?php echo $email['email']; ?>"/></td>
  </tr>
  <tr>
    <td width="204" style="font-size:12px" align="right">نام فرستنده :</td>
    <td width="423" style="font-size:12px" align="right"><input name="name" type="text" id="name" size="30" style="font-family:tahoma;font-size:12px"  value="<?php echo $email['name']; ?>" /></td>
  </tr>
  <tr>
    <td width="204" align="center"><input name="b" type="submit" class="font" id="b" onclick="email_setting();" value="ثبت تنظیمات ایمیل" style="font-family:ST;font-size:15px" /></td>
    <td width="423" align="right"></td>
  </tr>
</table>
</div>
</div>
</div>
</div>
<?php include"footer.php"; ?>
</body>
</html>
<?php 
 
  }  else { header("Location: ../index.php"); } ?>