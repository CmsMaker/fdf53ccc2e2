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

?>
<?php $db->sql_query ("SELECT * FROM `admin` WHERE `username`='".$_SESSION['admin']."'");
$data = $db->sql_fetcharray();


$db->sql_query ("SELECT * FROM `pages`");
$content = $db->sql_fetcharray();
?>
<?php include"header.php"; ?>
<script type="text/javascript" src="js/jquery.cleditor.min.js"></script>
<link rel="stylesheet" type="text/css" href="style/jquery.cleditor.css" />

<script type="text/javascript">
      $(document).ready(function() {
        $("#rule_page").cleditor()[0].focus();
      });
	  
	  $(document).ready(function() {
        $("#contact_page").cleditor()[0].focus();
      });
    </script>

<div class="middle">
<?php include"rsidebar.php"; ?>

<div class="post_box">
<div class="post_box_top">
  <div class="post_box_top_text">صفحات تماس با ما و قوانین</div>
</div>
<div class="post_box_content">
<table>
 <tr>
    	<td width="680" align="center" id="main"></td>
    </tr>
    </table>

<table border="0" cellspacing="15">
        <tr>
    <td width="140" style="font-size:12px;">متن صفحه قوانین :</td>

    </tr>
    <tr><td width="487" style="font-size:12px" align="right"><textarea rows="3" name="rule_page" id="rule_page" class="xxlarge"><?php echo $content['rule'];  ?></textarea>
    	</td></tr>
    <tr>
     <tr>
    <td width="140" style="font-size:12px;">متن صفحه تماس با ما :</td>

    </tr>
    <tr><td width="487" style="font-size:12px" align="right"><textarea rows="3" name="contact_page" id="contact_page" class="xxlarge"><?php echo $content['contact'];  ?></textarea>
    	</td></tr>
    <tr>
    	<td width="140" align="center"><input name="b" type="submit" class="font" id="b" onClick="rule_contact_page();" value="ارسال تغییرات" style="font-family:ST;font-size:15px" /></td>
    	<td width="487" align="right"><input name="Form" type="hidden" id="Form" value="rule_contact_page" /> 
        
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
<?php 
 
  }  else { header("Location: ../index.php"); } ?>