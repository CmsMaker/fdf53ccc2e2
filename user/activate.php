<?php 
if ( isset($_SESSION['user']) ) {

?><head>
<title>فعال سازی حساب کاربری</title>

<link rel="stylesheet" href="style.css" type="text/css" media="screen" />
<script src="js/jquery.js" type="text/javascript"></script>
<script src="data/js/ajax.js" type="text/javascript"></script>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<center>
<div class="user_activate_block">
<!----begin post---->
<div class="user_activate_block_top">
  <div class="user_activate_block_top_text">فعال سازی حساب کاربری</div></div>
<div class="index-content">
<center>
<br>
<table>
 <tr>
    	<td width="680" align="center" id="main"></td>
    </tr>
    </table>

<table width="296" border="0" cellspacing="15" dir="rtl">
    <tr>
      <td width="103" style="font-size:12px" align="right">کد فعال سازی</td>
      <td width="120" align="right"><input name="code" type="text" class="user_activate" id="code" /></td>
    </tr>
    <tr>
    	<td width="103" align="center"><input name="b" type="submit" class="font" id="b" onClick="user_activate();" value="فعال سازی" style="font-family:ST;font-size:15px" /></td>
    	<td width="120" align="right"><input name="Form" type="hidden" id="Form" value="active" /> 
        
               </td>
    </tr>
  
    </table>
      
      </center>
      
      </div>
<div class="index-bottom"></div>
<!----end of post---->
</div>

</center>
<div class=clear></div>
<?php } else { header("Location:../index.php"); } ?>