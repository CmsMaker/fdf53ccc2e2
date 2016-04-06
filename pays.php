<?php include"header.php"; ?>


<div class="middle">
<?php include"rsidebar.php"; ?>

<div class="post_box">
<div class="post_box_top">
  <div class="post_box_top_text">لیست پرداختی ها</div>
</div>
<div class="post_box_content">

   <p>&nbsp;</p>
   <p>20 پرداخت اخیر سیستم </p>
   <p>
   <p>
   <table width="520" border="0" align="center" style="border:#ACACAC solid 1px;">
        	<tr>
            <td width="203" height="20" bgcolor="#ACACAC" align="center">نام کاربری</td>
            <td width="166" height="20" bgcolor="#ACACAC" align="center">پورسانت دریافتی</td>
            	<td width="135" height="20" bgcolor="#ACACAC" align="center">تاریخ</td>
           	  	
        </tr>
<?php
	$db->sql_query("SELECT * FROM `paid_request` ORDER BY `id` DESC LIMIT 20");
while($rowpayment = $db->sql_fetcharray())
      {
        $pay =  $rowpayment['amount'];
		$user = $rowpayment['username'];
		$date = $rowpayment['date'];
?>
            <tr>
            <td width="203" height="20" align="center"><?php echo $user; ?></td>
            <td width="166" height="20" align="center"><?php echo $pay; ?> تومان</td>
            	<td width="135" height="20" align="center"><?php echo $date; ?></td>
                
           	  	
       	  	  
                
            </tr>
            <?php
	  }
	  ?>
        
      </table>
<p><p>
کل مبلغ پرداختی  : <?php all_pays() ?> تومان
  </font>


</div>
</div>
</div>
</div>
<?php include"footer.php"; ?>


</body>
</html>
