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
  <div class="post_box_top_text">زیر مجموعه های شما</div>
</div>
<div class="post_box_content">
<p>در زمان هایی که با زیرمجموعه های شما تسویه می شود، درآمد آنها در جدول زیر کاهش پیدا می کند. </p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>تشریح وضعیت زیرمجموعه های شما: </p>
<p>1- <font style="color:green">فعال</font> : کاربر میتواند در سیستم فعالیت کرده و به کسب درآمد بپردازد.</p>
<p>2- <font style="color:blue">غیرفعال</font> : کاربر هنوز حساب کاربری خود را با استفاده از کد فعال سازی، فعال نکرده است.</p>
<p>3- <font style="color:red">اخراج شده</font> : کاربر مورد نظر به دلیل تخلف از سایت اخراج شده است.</p>
<table width="617" align="center" style="font-size:12px;border:1px solid#999;margin-top:20px">
            	<tr bgcolor="#B0B0B0">
                <td width="50" height="20" align="center">ردیف</td>
                <td width="100" height="20" align="center">نام کاربری</td>
                <td width="80" height="20" align="center">درآمد</td>
				<td width="80" height="20" align="center">وضعیت</td>
               	  
                	
           	    
                	
                </tr>
                <?php
					$row = "1";
					$db->sql_query("SELECT * FROM `user` WHERE `refer`='".$_SESSION['user']."'");
					while($showResult=$db->sql_fetcharray()) {
						if(($row%2) != 0)
							$color = "#E5E5E5";
						else
							$color = "#F7F7F7";
					
					if($showResult['status'] == "1"){
						$status = "<font color=\"green\">فعال</font>";
					}
					elseif($showResult['status'] == "2"){
						$status = "<font color=\"red\">اخراج شده</font>";
					}
					elseif($showResult['status'] == "0"){
						$status = "<font color=\"blue\">غیر فعال</font>";
					}
				?>
            	<tr bgcolor="<?php echo $color; ?>" class="tableTab">
                <td width="50" height="20" align="center"><?php echo $row; ?></td>
                <td width="100" height="20" align="center"><?php echo $showResult['username']; ?></td>
                
                <td width="80" height="20" align="center"><?php echo $showResult['mony']; ?> ریال</td>
                	<td width="80" height="20" align="center"><?php echo $status; ?></td>
                  
                    
                	
           	    
                	
                </tr>
                <?php
					$row++;
					}
				?>
                	
                <tr>
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