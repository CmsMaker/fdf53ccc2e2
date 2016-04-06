<?php
session_start();
if ( isset($_SESSION['user']) ) {
	
include "../../config.php";
include "../../include/mysql.class.php";
$db = new Mysql($host,$dbuname,$dbpass,$dbname,false); //create database object
$db->Database_Connect(); //connect to database

 if ( isset($_GET['id']) ) {
	
	$site_id = $_GET['id'];
	$db->sql_query("SELECT * FROM `sites` WHERE `id`=$site_id");
	$site_info = $db->sql_fetcharray();
?><head>
<script src="data/js/ajax.js" type="text/javascript"></script>
<script src="data/ajax/ajax.js" type="text/javascript"></script>
</head>
<meta charset="utf-8">
<table border="0" cellspacing="10" id="status" style="font-family:tahoma;font-size:12px"  dir="rtl">
 <tr>
        	<td align="right" colspan="2">بعد از ویرایش ، اطلاعات سایت برای تایید مدیریت ارسال خواهد شد.</td>
        </tr>
 <tr>
        	<td align="center" id="main" colspan="2"></td>
        </tr>
<input name="site_id" type="hidden" id="site_id" value="<?php echo $site_id; ?>" />
 <tr>
        <td width="116" height="20" align="right">عنوان سایت</td>
        	<td width="192" height="20" align="right"><input name="title" type="text" id="title" style="font-family:tahoma;font-size:12px" value="<?php echo $site_info['title']; ?>" size="40" /></td>
        	
        </tr>
         <tr>
        <td width="116" height="20" align="right">آدرس سایت</td>
        	<td height="20" align="right"><input name="url" type="text" id="url" style="font-family:tahoma;font-size:12px"  value="<?php echo $site_info['url']; ?>" size="40" dir="ltr" /></td>
        	
        </tr>
        <tr>
        	<td width="116" height="20" align="right"><input name="Form" type="submit" id="Form" value="ویرایش سایت" onclick="site_edit();" /></td>

        </tr>
       
      </table>
      <?php 
	  
	  }
else {
	header("Location:../index.php");
	}
	  
	  } ?>
