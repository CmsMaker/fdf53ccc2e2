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
  <div class="post_box_top_text">درخواست واریز درآمد</div>
</div>
<div class="post_box_content">

  <p>&nbsp;</p>
  <p>حداقل مبلغ قابل درخواست : <?php echo $request; ?> ریال</p>
  <p>تا زمانی که پیام موفقیت آمیز یا خطا در ارسال درخواست را مشاهده نکرده اید مجددا بر روی دکمه ارسال درخواست کلیک نکنید.</p>
  <p>به ازای هر درخواست اضافی 10% از درآمد شما کثر خواهد شد.</p>
  <br />
  <p><font color="#FF0000">تـــــــوجـــــــــه:</font> در زمان واریز به حساب های بانکی غیر از <font color="#0000FF">&quot;بانک ملی&quot;</font> 500 تومان به عنوان هزینه انتقال، کسر خواهد شد. توصیه می کنیم قبل از درخواست ، یک حساب بانک ملی در قسمت &quot;اطلاعات حساب بانکی&quot; وارد نمائید و یا با افزایش درآمد خود و برداشت یکجای آن، فقط یک بار 500 تومان کسر شود.</p>
  <?php
  if($data['mony'] < $request){
	  echo "<p style=\"font-family:ST;padding:30px 0 20px 0;text-align:center;font-weight:bold;font-size:20px;color:red\">درآمد شما از $request ریال  کمتر می باشد.</p>";
  }
  elseif($data['mony'] > $request || $data['mony'] == $request){
   ?>
   <table width="676">
<tr>
        	<td align="center" id="main" colspan="2"></td>
        </tr>

</table>
<table width="676" border="0" cellspacing="10">
        <tr>
        <td width="102" height="20" style="font-size:12px" align="right">مبلغ درخواستی</td>
        	<td height="20" align="right"><input name="amount" type="text" id="amount" style="font-family:tahoma;font-size:12px" /> 
        	ریال</td>
        	
        </tr>
        <tr>
        	<td width="102" height="20" align="right"><input name="Form" type="submit" id="Form" value="ارسال درخواست" onclick="user_request()" /></td>
        	<td width="540" height="20" align="right"></td>
        </tr>
        </table>
  <?php } ?>
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