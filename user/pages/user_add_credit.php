<?php
session_start();
if ( isset($_SESSION['user']) ) {
 if ( isset($_GET['id']) ) {
	
	$site_id = $_GET['id'];

?><head>
<script src="js/jquery.js" type="text/javascript"></script>
<script src="data/js/ajax.js" type="text/javascript"></script>
</head>
<meta charset="utf-8">
<table border="0" cellspacing="10" id="status" style="font-family:tahoma;font-size:12px"  dir="rtl">
 <tr>
        	<td width="320" align="center" id="main" colspan="2"></td>
        </tr>
<input name="site_id" type="hidden" id="site_id" value="<?php echo $site_id; ?>" />
 <tr>
        <td width="142" height="20" align="right">تعداد بازدید</td>
        	<td height="20" align="right"><input name="credit" type="text" id="credit" style="font-family:tahoma;font-size:12px" /></td>
        	
        </tr>
        <tr>
        	<td width="142" height="20" align="right"><input name="Form" type="submit" id="Form" value="افزودن بازدید" onclick="site_add_credit();" /></td>

        </tr>
       
      </table>
      <?php 
	  
	  }
else {
	header("Location:../index.php");
	}
	  
	  } ?>
