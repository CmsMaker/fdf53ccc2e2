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
  <div class="post_box_top_text">مشخصات حساب بانکی</div>
</div>
<div class="post_box_content">

<table>
 <tr>
    	<td width="680" align="center" id="main"></td>
    </tr>
    </table>

<table border="0" cellspacing="15">
      
    <tr>
    <td width="140" style="font-size:12px" align="right">نام صاحب حساب</td>
    	<td width="487" style="font-size:12px" align="right"><input name="bank_owner" type="text" class="bank_info" id="bank_owner" value="<?php echo $data['bank_owner']; ?>" /></td>
    	
    </tr>
    <tr>
        	<td width="140" style="font-size:12px" align="right">شماره حساب</td>
    	<td width="487" style="font-size:12px" align="right"><input name="bank_number" type="text" class="bank_info" id="bank_number"  value="<?php echo $data['bank_number']; ?>" /></td>
    </tr>
    <tr>
    <td width="140" style="font-size:12px" align="right">شماره کارت</td>
    	<td width="487" align="right"><input name="bank_cart" type="text" class="bank_info" id="bank_cart" value="<?php echo $data['bank_cart']; ?>" /></td>
    	
    </tr>
    <tr>
    <td width="140" style="font-size:12px" align="right">شماره شبا</td>
    	<td width="487" align="right"><input name="bank_shaba" type="text" class="bank_info" id="bank_shaba" value="<?php echo $data['bank_shaba']; ?>" /></td>
    	
    </tr>
    <tr>
    <td width="140" style="font-size:12px" align="right">نام بانک</td>
    	<td width="487" align="right"><select name="bank_name" id="bank_name" style="font-family:tahoma;font-size:12px">
    <?php
	$bank_name_table = mysql_query("SELECT * FROM `bank_name`");
	while($row_bank_name = mysql_fetch_array($bank_name_table))
      {
        $bank_name =  $row_bank_name['bank_name'];
		$bank_id =  $row_bank_name['id'];
			?>
                	<option value="<?php echo $bank_id;?>" <?php if($data['bank_name'] == $bank_id){echo "selected=\"selected\""; } ?>><?php echo $bank_name;?> </option>

<?php }?>                </select></td>
    	
    </tr>
    
    <tr>
    	<td width="140" align="center"><input name="b" type="submit" class="font" id="b" onClick="bank_info();" value="ثبت تغییرات" style="font-family:ST;font-size:15px" /></td>
    	<td width="487" align="right"><input name="Form" type="hidden" id="Form" value="bank_info" /> 
        
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