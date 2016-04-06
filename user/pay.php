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
  <div class="post_box_top_text">پرداخت آنلاین</div>
</div>
<div class="post_box_content">
<p>از این قسمت میتوانید مبلغ مورد نظر را با استفاده از کارت های عضو شتاب به صورت آنلاین پرداخت نمائید. </p>
<p>مبلغ مورد نظر به واحد بازدید تبدیل شده و به حساب کاربری شما به صورت اتوماتیک افزوده خواهد شد.</p>
<table width="246" border="0" align="center" style="border:#ACACAC solid 1px;font-size:12px;margin-top:15px">
        <tr>
            <td width="101" bgcolor="#ACACAC" height="20" align="center">تعرفه پرداخت</td>
                <td width="101" bgcolor="#ACACAC" height="20" align="center">تعداد بازدید</td>
           	  	
       	  	  
                
            </tr>
            
            
            
            <form id="form1" name="form1" method="post" action="payment.php">
            <?php $db->sql_query("SELECT * FROM `tariff` ORDER BY `id` ASC");
			while($tariff=$db->sql_fetcharray()){
			
			
			 ?>
             <tr>
            <td width="101" align="right" bgcolor="#DFDFDF">
  <input type="radio" name="amount" id="<?php echo $tariff['id']; ?>" value="<?php echo $tariff['tariff']; ?>" />
  <label for="1"><?php echo $tariff['tariff']; ?> ریال</label>
  <br />
  </td>
  <td  bgcolor="#DFDFDF"> <?php $hit = ($tariff['tariff']) / ($hit_cost); echo round($hit); ?>   بازدید</td>
  
  </tr>
  <?php } ?>
  <tr>
  <td>
  <input style="font-family:ST;font-size:15px" align="center" type="submit" value="پرداخت" /></td></tr>
  </form>
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