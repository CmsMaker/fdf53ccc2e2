<?php include"header.php"; ?>

<?php 
	if(isset($_GET['refer'])){
		
		$get_refer = htmlspecialchars($_GET['refer']);
		$db->sql_query("SELECT * FROM `user` WHERE `username`='".$get_refer."'");
		$refer_fetch = $db->sql_fetcharray();
		
		if($refer_fetch['refering'] == "1"){
			
			$refer = $get_refer;
		}else {
			
			$refer = "";	
		}
	}
?>
<div class="middle">
<?php include"rsidebar.php"; ?>

<div class="post_box">
<div class="post_box_top">
  <div class="post_box_top_text">عضویت کاربران</div>
</div>
<div class="post_box_content">
<table>
 <tr>
    	<td width="680" align="center" id="main"></td>
    </tr>
    </table>

<table border="0" cellspacing="15">
      
    <tr>
    <td width="140" style="font-size:12px" align="right">نام و نام خانوادگی</td>
    	<td width="487" style="font-size:12px" align="right"><input name="name" type="text" class="user_register" id="name" /> 
    	فقط با حروف فارسی نوشته شود.</td>
    	
    </tr>
    <tr>
        	<td width="140" style="font-size:12px" align="right">شماره همراه</td>
    	<td width="487" style="font-size:12px" align="right"><input name="mobile" type="text" class="user_register" id="mobile" style="direction:ltr;text-align:left;" /></td>
    </tr>
    <tr>
    <td width="140" style="font-size:12px" align="right">آدرس ایمیل</td>
    	<td width="487" align="right" style="font-size:12px"><input style="direction:ltr;text-align:left;" name="email_adr" type="text" id="email_adr" style="direction:ltr;text-align:left" /></td>
    	
    </tr>
    <tr>
    <td width="140" style="font-size:12px" align="right">نام کاربری</td>
    	<td width="487" align="right"><input name="username" type="text" class="user_register" id="username" style="direction:ltr;text-align:left;" value="" /></td>
    	
    </tr>
    <tr>
    <td width="140" style="font-size:12px" align="right">کلمه عبور</td>
    	<td width="487" align="right"><input name="pass" type="password" class="user_register" id="pass" /></td>
    	
    </tr>
    <tr>
        	<td width="140" style="font-size:12px" align="right">تکرار کلمه عبور</td>
    	<td width="487" align="right"><input name="try_password" type="password" class="user_register" id="try_password" /></td>
    </tr>
    <tr>
        	<td width="140" style="font-size:12px" align="right">معرف</td>
    	<td width="487" align="right"><input name="refer" type="text" class="user_register" id="refer" disabled="disabled" value="<?php if (isset($refer)) {echo $refer; }?>" /></td>
    </tr>
    <tr>
      
      <td  height="20" style="font-size:12px" colspan="2" align="right" dir="rtl"><input name="c" type="checkbox" id="c" onClick="check_1();" />
        <label for="c"> قوانین و مقررات سایت را قبول دارم</label></td>
    </tr>
    <tr>
    	<td width="140" align="center"><input name="b" type="submit" class="font" id="b" onClick="user_register();" value="ثبت نام" style="font-family:ST;font-size:15px" disabled="disabled" /></td>
    	<td width="487" align="right"><input name="Form" type="hidden" id="Form" value="user" /> 
        
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
