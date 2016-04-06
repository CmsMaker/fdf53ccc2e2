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
  <div class="post_box_top_text">ارتقاء سطح کاربری</div>
</div>
<div class="post_box_content">
<?php 
		
		if($data['level'] == 1){
	
	
	 ?>
<table width="246" border="0" align="center" style="border:#ACACAC solid 1px;font-size:12px;margin-top:30px">
        <tr>
            <td width="101" bgcolor="#ACACAC" height="20" align="center">سطح کاربری</td>
                <td width="101" bgcolor="#ACACAC" height="20" align="center">تعرفه فعال سازی</td>
           	  	
       	  	  
                
            </tr>
            
            
            
            <form id="form1" name="form1" method="post" action="upgrade_payment.php">
             <tr>
            <td width="101" align="right" bgcolor="#DFDFDF">
  <input type="radio" name="level" id="level" value="2" />
  <label for="2">سطح نقره ای</label>
  <br />
  </td>
  <td  bgcolor="#DFDFDF"> <?php echo $level_silver_cost; ?> ریال  </td>
  
  </tr>
  
  			<tr>
            <td width="101" align="right" bgcolor="#DFDFDF">
  <input type="radio" name="level" id="level" value="3" />
  <label for="3">سطح طلایی</label>
  <br />
  </td>
  <td  bgcolor="#DFDFDF"> <?php echo $level_golden_cost; ?> ریال  </td>
  
  </tr>
  <tr>
  <td>
  <input style="font-family:ST;font-size:15px" align="center" type="submit" value="پرداخت" /></td></tr>
  </form>
        </table>
<?php }

else {
	
	echo "<p style='text-align:center;color:green;font-weight:bold;padding:30px 0 20px 0'>سطح کاربری شما ارتقا یافته است و تا پایان مدت زمان این سطح کاربری، نمیتوانید سطح دیگری را انتخاب نمائید.</p>";
	
	}


 ?>
</div></div>
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