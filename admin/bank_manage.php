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

if(isset($_GET['action']) == "delete") {
	$id = $_GET['id'];
}
if((isset($_GET['action'])) && ($id != "")) {
	if($db->sql_query("DELETE FROM `bank_name` WHERE `id`='$id'")) {
		header("Location: bank_manage.php");
	}
}

 $db->sql_query ("SELECT * FROM `admin` WHERE `username`='".$_SESSION['admin']."'");
$data = $db->sql_fetcharray();

?>
<?php include"header.php"; ?>
<script language="javascript">
	
	function del_bank(id)
	{
		if(confirm("آیا می خواهید این بانک را حذف کنید؟"))
		{
			document.location.href="?action=delete&id="+id;
		}
		else
		{}
	}
</script>

<div class="middle">
<?php include"rsidebar.php"; ?>

<div class="post_box">
<div class="post_box_top">
  <div class="post_box_top_text">مدیریت نام بانک ها</div>
</div>
<div class="post_box_content">
  <table width="670px">
 <tr>
        	<td width="320" align="center" id="main" colspan="2"></td>
        </tr>
        </table>
<table border="0" cellspacing="10" id="status" style="font-size:12px">

		<tr>
        <td width="120" height="20" align="right">نام بانک عضو شتاب :</td>
        	<td height="20" align="right"><input name="bank_name" type="text" id="bank_name" style="font-family:tahoma;font-size:12px" size="30" />
            </td>
        	
        </tr>
        <tr>
        	<td width="200" height="20" align="right"><input name="Form" type="submit" id="Form" value="افزودن بانک" onclick="bank_add();" /></td>

        </tr>
       
      </table>
      <table style="border:1px solid #000000;" align="center" >
    	<tr>
        <td width="150" height="20" bgcolor="#ACACAC" align="center">نام بانک</td>
        	<td width="60" height="20" bgcolor="#ACACAC" align="center">حذف کردن</td>
        	
        </tr>
        
        <?php
			$db->sql_query("SELECT * FROM `bank_name` ORDER BY id ASC");

				while($fetch = $db->sql_fetcharray()){
		?>
    	<tr bgcolor="#F3F3F3">
        <td width="150" height="20" align="center" dir="rtl"><?php echo $fetch['bank_name']; ?></td>
        	<td width="60" height="20" align="center"><a href="javascript:del_bank(<?php echo $fetch['id']; ?>)"><img src="images/delete.png" border="0" /></a></td>
        	
        </tr>
        <?php
			}
		?>
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