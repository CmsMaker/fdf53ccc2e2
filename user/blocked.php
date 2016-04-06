<?php 
if ( isset($_SESSION['user']) ) {

?><head>
<title>حساب کاربری غیر فعال</title>

<link rel="stylesheet" href="style.css" type="text/css" media="screen" />
<script src="data/js/ajax.js" type="text/javascript"></script>
<script src="data/ajax/ajax.js" type="text/javascript"></script>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<center>
<div class="user_activate_block">
<!----begin post---->
<div class="user_activate_block_top">
  <div class="user_activate_block_top_text">غیـــــــر فعــــــال</div></div>
<div class="index-content">
<center>
<br />
<p style="font-family:ST;font-size:15px;color:#F00">

حساب کاربری شما به دلیل تخلف مسدود شده است. لطفا با مدیریت تماس بگیرید
      <p><br />
        
      </center>
      
      </div>
<div class="index-bottom"></div>
<!----end of post---->
</div>

</center>
<div class=clear></div>
<?php } else { header("Location:../index.php"); } ?>