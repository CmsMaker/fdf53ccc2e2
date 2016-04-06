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
  <div class="post_box_top_text">سوابق پرداخت های آنلاین</div>
</div>
<div class="post_box_content">

<table width="663" border="0" align="center" style="border:#ACACAC solid 1px;font-size:12px;margin-top:15px">
        	<tr>
            <td width="111" height="20" bgcolor="#ACACAC" align="center">مبلغ</td>
            <td width="138" height="20" bgcolor="#ACACAC" align="center">شماره فيش</td>
            <td width="287" height="20" bgcolor="#ACACAC" align="center">نوع پرداخت</td>
            	<td width="107" height="20" bgcolor="#ACACAC" align="center">تاریخ واریز</td>
           	  	
       	  	  
                
            </tr>
            <?php
			$db->sql_query("SELECT * FROM `pays` WHERE `username`='{$_SESSION['user']}' ORDER BY id DESC");
			while($fetch = $db->sql_fetcharray())
			{
			
			?>
        	<tr>
            <td width="111" height="20" align="center"><?php echo $fetch['amount']; ?> ریال</td>
            <td width="138" height="20" align="center"><?php echo $fetch['fish']; ?></td>
            <td width="287" height="20" align="center"><?php echo $fetch['type']; ?></td>
            	<td width="107" height="20" align="center"><?php echo $fetch['date']; ?></td>
           	  	
       	  	  
                
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