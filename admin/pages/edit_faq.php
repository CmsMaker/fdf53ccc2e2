<?php
session_start();
if ( isset($_SESSION['admin']) ) {
	
include "../../config.php";
include "../../include/mysql.class.php";
$db = new Mysql($host,$dbuname,$dbpass,$dbname,false); //create database object
$db->Database_Connect(); //connect to database

 if ( isset($_GET['id']) ) {
	
	$id = $_GET['id'];
	
	$db->sql_query("SELECT * FROM `faq` WHERE `id`=$id");
	$faq = $db->sql_fetcharray();
?><head>
<script src="data/admin/js/ajax.js" type="text/javascript"></script>
<script src="data/admin/ajax/ajax.js" type="text/javascript"></script>
<script src="js/jquery.js" type="text/javascript"></script>
<script type="text/javascript" src="js/jquery.cleditor.min.js"></script>
<link rel="stylesheet" type="text/css" href="style/jquery.cleditor.css" />

<script type="text/javascript">
      $(document).ready(function() {
        $("#text").cleditor()[0].focus();
      });
    </script>
</head>
<meta charset="utf-8">
<table width="435" border="0" cellspacing="15" dir="rtl" >
       <tr>
        	<td align="center" id="main" colspan="2"></td>
        </tr>
    <tr>
    <td width="140" style="font-size:12px" align="right">عنوان سوال :</td>

    </tr>
    <tr>
    <td width="487" style="font-size:12px" align="right"><input name="title" type="text" id="title" size="80" style="font-family:tahoma;font-size:12px" value="<?php echo $faq['title'] ?>" /> 
</td>
    
    </tr>
        <tr>
    <td width="140" style="font-size:12px;">متن سوال :</td>

    </tr>
    <tr><td width="487" style="font-size:12px" align="right"><textarea rows="3" name="text" id="text" class="xxlarge"><?php echo $faq['text'] ?></textarea>
    	</td></tr>
    <tr>
    	<td width="140" align="center"><input name="b" type="submit" class="font" id="b" onClick="faq_edit();" value="ویرایش سوال" style="font-family:ST;font-size:15px" />
<input name="Form" type="hidden" id="Form" value="faq_edit" />
<input name="id" type="hidden" id="id" value="<?php echo $faq['id'] ?>" />
</td>
    </tr>
  
    </table>
      <?php 
	  
	  }
else {
	header("Location:../index.php");
	}
	  
	  } ?>
