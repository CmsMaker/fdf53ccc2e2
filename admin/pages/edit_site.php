<?php
session_start();
if ( isset($_SESSION['admin']) ) {
	
include "../../config.php";
include "../../include/mysql.class.php";
$db = new Mysql($host,$dbuname,$dbpass,$dbname,false); //create database object
$db->Database_Connect(); //connect to database

 if ( isset($_GET['id']) ) {
	
	$id = $_GET['id'];
	$db->sql_query("SELECT * FROM `sites` WHERE `id`=$id");
	$site_info = $db->sql_fetcharray();
?><head>
<script src="../data/admin/js/ajax.js" type="text/javascript"></script>
</head>
<meta charset="utf-8">
<table border="0" cellspacing="10" id="status" style="font-family:tahoma;font-size:12px"  dir="rtl">
 <tr>
        	<td align="center" id="main" colspan="2"></td>
        </tr>
<input name="id" type="hidden" id="id" value="<?php echo $id; ?>" />
 <tr>
        <td width="116" height="20" align="right">نام سایت</td>
        	<td width="192" height="20" align="right"><input name="name" type="text" id="name" style="font-family:tahoma;font-size:12px" value="<?php echo $site_info['title']; ?>" size="40" /></td>
        	
        </tr>
        <tr>
        <td width="116" height="20" align="right">آدرس سایت</td>
        	<td height="20" align="right"><input name="url" type="text" id="url" style="font-family:tahoma;font-size:12px"  value="<?php echo $site_info['url']; ?>" size="40" dir="ltr" /></td>
        	
        </tr>
        <tr>
        	<td width="116" height="20" align="right"><input name="Form" type="submit" id="Form" value="ویرایش سایت" onclick="edit_site();" /></td>

        </tr>
       
      </table>
      <?php 
	  
	  }
else {
	header("Location:../index.php");
	}
	  
	  } ?>
