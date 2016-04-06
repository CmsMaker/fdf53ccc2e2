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

?>
<?php include"header.php"; ?>


<div class="middle">
<?php include"rsidebar.php"; ?>

<div class="post_box">
<div class="post_box_top">
  <div class="post_box_top_text">تنظیمات سیستم</div>
</div>
<div class="post_box_content">
<table>
 <tr>
    	<td width="680" align="center" id="main"></td>
    </tr>
    </table>

<table border="0" cellspacing="15">
      
    <tr>
    <td width="247" style="font-size:12px" align="right">نام هاست :</td>
<td width="380" style="font-size:12px" align="right"><input name="hostname" type="text" id="hostname" size="30" style="font-family:tahoma;font-size:12px"  value="<?php echo $host; ?>"/>
</td>
    
    </tr>
        <tr>
    <td width="247" style="font-size:12px" align="right">نام کاربری دیتابیس:</td>
<td width="380" style="font-size:12px" align="right"><input name="db_username" type="text" id="db_username" size="30" style="font-family:tahoma;font-size:12px"  value="<?php echo $dbuname; ?>" /> 
</td>
    
    </tr>
        <tr>
    <td width="247" style="font-size:12px" align="right">کلمه عبور دیتابیس :</td>
<td width="380" style="font-size:12px" align="right"><input name="db_password" type="text" id="db_password" size="30" style="font-family:tahoma;font-size:12px"  value="<?php echo $dbpass; ?>" /> 
</td>
    
    </tr>
    <tr>
    <td width="247" style="font-size:12px" align="right">نام دیتابیس :</td>
<td width="380" style="font-size:12px" align="right"><input name="db_name" type="text" id="db_name" size="30" style="font-family:tahoma;font-size:12px"  value="<?php echo $dbname; ?>" /> 
</td>
    
    </tr>
    <tr>
    <td width="247" style="font-size:12px" align="right">تعرفه بازدید (ریال) :</td>
<td width="380" style="font-size:12px" align="right"><input name="hit_cost" type="text" id="hit_cost" size="30" style="font-family:tahoma;font-size:12px"  value="<?php echo $hit_cost; ?>" /> 
</td>
    
    </tr>
    <tr>
    <td width="247" style="font-size:12px" align="right">پورسانت کاربر برنزی (ریال) :</td>
<td width="380" style="font-size:12px" align="right"><input name="bronze_user_cost" type="text" id="bronze_user_cost" size="30" style="font-family:tahoma;font-size:12px"  value="<?php echo $bronze_user_cost; ?>" /> 
</td>
    
    </tr>
    <tr>
    <td width="247" style="font-size:12px" align="right">پورسانت کاربر نقره ای (ریال) :</td>
<td width="380" style="font-size:12px" align="right"><input name="silver_user_cost" type="text" id="silver_user_cost" size="30" style="font-family:tahoma;font-size:12px"  value="<?php echo $silver_user_cost; ?>" /> 
</td>
    
    </tr>
    <tr>
    <td width="247" style="font-size:12px" align="right">پورسانت کاربر طلایی (ریال) :</td>
<td width="380" style="font-size:12px" align="right"><input name="golden_user_cost" type="text" id="golden_user_cost" size="30" style="font-family:tahoma;font-size:12px"  value="<?php echo $golden_user_cost; ?>" /> 
</td>
    
    </tr>
    <tr>
    <td width="247" style="font-size:12px" align="right">پورسانت کاربر از زیرمجموعه (درصد) :</td>
<td width="380" style="font-size:12px" align="right"><input name="from_refer" type="text" id="from_refer" size="30" style="font-family:tahoma;font-size:12px"  value="<?php echo $from_refer; ?>" /> 
</td>
    
    </tr>
    <tr>
    <td width="247" style="font-size:12px" align="right">هزینه فعالسازی زیرمجموعه گیری (ریال) :</td>
<td width="380" style="font-size:12px" align="right"><input name="refering_activation" type="text" id="refering_activation" size="30" style="font-family:tahoma;font-size:12px"  value="<?php echo $refering_activation; ?>" /> 
</td>
    
    </tr>
    <tr>
    <td width="247" style="font-size:12px" align="right">هزینه سطح کاربری نقره ای (ریال) :</td>
<td width="380" style="font-size:12px" align="right"><input name="level_silver_cost" type="text" id="level_silver_cost" size="30" style="font-family:tahoma;font-size:12px"  value="<?php echo $level_silver_cost; ?>" /> 
</td>
    
    </tr>
    <tr>
    <td width="247" style="font-size:12px" align="right">هزینه سطح کاربری طلایی (ریال) :</td>
<td width="380" style="font-size:12px" align="right"><input name="level_golden_cost" type="text" id="level_golden_cost" size="30" style="font-family:tahoma;font-size:12px"  value="<?php echo $level_golden_cost; ?>" /> 
</td>
    
    </tr>
    <tr>
    <td width="247" style="font-size:12px" align="right">حداقل مبلغ قابل درخواست (ریال) :</td>
<td width="380" style="font-size:12px" align="right"><input name="min_request" type="text" id="min_request" size="30" style="font-family:tahoma;font-size:12px"  value="<?php echo $request; ?>" /></td>
    
    </tr>
    <tr>
    <td width="247" style="font-size:12px" align="right">درگاه پی لاین :</td>
<td width="380" style="font-size:12px" align="right"><input name="payline" type="text" id="payline" size="30" style="font-family:tahoma;font-size:12px"  value="<?php echo $payline; ?>" /> 
</td>
    
    </tr>
    <tr>
    <td width="247" style="font-size:12px" align="right">لینک سایت :</td>
<td width="380" style="font-size:12px" align="right"><input name="url" type="text" id="url" size="30" style="font-family:tahoma;font-size:12px"  value="<?php echo $link; ?>" /> مثال : http://bazdidsaz.com
</td>
    
    </tr>
    
    <tr>
    	<td width="247" align="center"><input name="b" type="submit" class="font" id="b" onClick="setting();" value="ثبت تنظیمات" style="font-family:ST;font-size:15px" /></td>
    	<td width="380" align="right"><input name="Form" type="hidden" id="Form" value="setting" /> 
        
               </td>
    </tr>
  
    </table></div>
</div>
</div>
</div>
<?php include"footer.php"; ?>
</body>
</html>
<?php 
 
  }  else { header("Location: ../index.php"); } ?>