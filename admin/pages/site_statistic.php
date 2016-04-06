<?php
session_start();
if ( isset($_SESSION['admin']) ) {
	
include "../../config.php";
include "../../include/mysql.class.php";
include "../data/admin/function.php";
$db = new Mysql($host,$dbuname,$dbpass,$dbname,false); //create database object
$db->Database_Connect(); //connect to database

 if ( isset($_GET['id']) ) {
	
	$site_id = $_GET['id'];
	$db->sql_query("SELECT * FROM `sites` WHERE `id`=$site_id");
	$site_info = $db->sql_fetcharray();
	
	$url = $site_info['url'];
?><head>
</head>
<meta charset="utf-8">
<table width="500" border="0" cellspacing="10"  dir="rtl" id="status" style="font-family:tahoma;font-size:12px">
 <tr>
        	<td align="center" id="main" colspan="2"></td>
        </tr>
         <tr>
        <td width="129" height="20" align="right" class="info_td">عنوان سایت</td>
        	<td width="337" height="20" align="right" ><?php echo $site_info['title']; ?></td>
        	
        </tr>
                 <tr>
        <td width="129" height="20" align="right" class="info_td">آدرس سایت</td>
        	<td width="337" height="20" align="right"><?php echo $site_info['url']; ?></td>
        	
        </tr>
         <tr>
        <td width="129" height="20" align="right" class="info_td">بازدید باقیمانده</td>
        	<td width="337" height="20" align="right"><?php echo $site_info['credit']; ?></td>
        	
        </tr>
         <tr>
        <td width="129" height="20" align="right" class="info_td">بازدید دریافتی</td>
        	<td width="337" height="20" align="right"><?php echo $site_info['view']; ?></td>
        	
        </tr>
<?php alexa($url); ?>


</table>
      <?php 
	  
	  }
else {
	header("Location:../index.php");
	}
	  
	  } ?>
