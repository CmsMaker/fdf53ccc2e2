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
  <div class="post_box_top_text">افزودن سایت برای دریافت بازدید</div>
</div>
<div class="post_box_content">
 <table>
 <tr>
    	<td width="680" align="center" id="main"></td>
    </tr>
    </table>

<table border="0" cellspacing="15">
      <tr><font style="font-family:ST;font-size:16px;color:#F00;line-height:25px">برای مشاهده قوانین افزودن سایت، به صفحه قوانین سایت مراجعه نمائید.

      
      </font></tr>
    <tr>
    <td width="140" style="font-size:12px" align="right">عنوان سایت</td>
    	<td width="487" style="font-size:12px" align="right"><input name="site_title" type="text" class="site_add" id="site_title" size="30" /></td>
    	
    </tr>
    <tr>
        	<td width="140" style="font-size:12px" align="right">آدرس سایت</td>
    	<td width="487" style="font-size:12px" align="right"><input name="site_url" type="text" class="site_add" id="site_url" dir="ltr" value="http://www." size="30" /></td>
    </tr>
    <tr>
    <td width="140" style="font-size:12px" align="right">تعداد بازدید</td>
    	<td width="487" align="right"><input name="site_credit" type="text" class="site_add" id="site_credit" size="30" /></td>
    	
    </tr>
    
    <tr>
    	<td width="140" align="center"><input name="b" type="submit" class="font" id="b" onClick="site_add();" value="افزودن سایت" style="font-family:ST;font-size:15px" /></td>
    	<td width="487" align="right"><input name="Form" type="hidden" id="Form" value="site_add" /> 
        
          </td>
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