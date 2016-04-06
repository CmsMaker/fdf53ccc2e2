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
  <div class="post_box_top_text">ارسال تیکت پشتیبانی</div>
</div>
<div class="post_box_content">
<table width="676">
<tr>
        	<td align="center" id="main" colspan="2"></td>
        </tr>

</table>
<table width="676" border="0" cellspacing="10">
        <tr>
        <td width="118" height="20" style="font-size:12px" align="right">عنوان تیکت پشتیبانی</td>
        	<td height="20" align="right"><input name="title" type="text" id="title" style="font-family:tahoma;font-size:12px" /></td>
        	
        </tr>
        <tr>
        <td width="118" height="20" style="font-size:12px" align="right">متن تیکت</td>
        	<td width="524" height="20" align="right"><textarea name="text" id="text" rows="5" cols="50" style="font-family:tahoma;font-size:12px"></textarea></td>
        	
        </tr>
        <tr>
        	<td width="118" height="20" align="right"><input name="Form" type="submit" id="Form" value="ارسال پیام" onclick="user_ticket()" /></td>
        	<td width="524" height="20" align="right"></td>
        </tr>
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