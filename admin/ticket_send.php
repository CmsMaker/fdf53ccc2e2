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
  <div class="post_box_top_text">ارسال پیام به کاربران</div>
</div>
<div class="post_box_content">
<table width="670px">
 <tr>
        	<td width="320" align="center" id="main" colspan="2"></td>
        </tr>
        </table>
<table border="0" cellspacing="10" id="status" style="font-size:12px">
		<tr>
        <td width="120" height="20" align="right">نوع ارسال</td>
        	<td height="20" align="right">
            	<select name="send_type" id="send_type" onchange="SetStatus()" style="font-family:tahoma;font-size:12px">
                	<option value="OneMember">ارسال به كاربر انتخابي</option>
                    <option value="AllMember">ارسال به همه كاربران</option>
                </select>
            </td>
        	
        </tr>
		<tr>
        <td width="120" height="20" align="right">ارسال پیام به (نام کاربری)</td>
        	<td height="20" align="right"><input name="to" type="text" id="to" style="font-family:tahoma;font-size:12px" size="30" />
            </td>
        	
        </tr>
        <tr>
        <td width="120" height="20" align="right">عنوان پیام</td>
        	<td height="20" align="right"><input name="title" type="text" id="title" style="font-family:tahoma;font-size:12px" size="30" /></td>
        	
        </tr>
        <tr>
        <td width="120" height="20" align="right">متن پیام</td>
        	<td width="200" height="20" align="right"><textarea name="text" rows="5" cols="30" id="text" style="font-family:tahoma;font-size:12px" ></textarea></td>
        	
        </tr>
        <tr>
        	<td width="200" height="20" align="right"><input name="Form" type="submit" id="Form" value="ارسال پیام" onclick="ticket_send();" /></td>

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