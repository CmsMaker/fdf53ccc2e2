
<head>
<style type="text/css">
.auto-style1 {
	text-align: center;
}
</style>
</head>

<?php include"header.php"; ?>


<div class="middle">
<div class="news_box">
<div class="news_box_top"><div class="news_box_top_text">&#1575;&#1582;&#1576;&#1575;&#1585; &#1587;&#1740;&#1587;&#1578;&#1605;</div>
</div>
<div class="news_box_content">
<table width="635">
<?php 
$db->sql_query("SELECT * FROM `news` ORDER BY id DESC LIMIT 10");
while($news = $db->sql_fetcharray()){

?>
<tr>
<td width="499" class="news_td"><a id="example1" href="news.php?id=<?php echo $news['id'] ?>"><?php echo $news['title'] ?></a></td>
<td width="124" style="text-align:center"><?php echo $news['date'] ?></td>
</tr>
<?php } ?>
    </table>
</div>
</div>

<div class="login_box">
<div class="login_box_top">
  <div class="login_box_top_text">&#1608;&#1585;&#1608;&#1583; &#1705;&#1575;&#1585;&#1576;&#1585;&#1575;&#1606;</div>
  </div>
  <div class="news_box_content">
  <table class="login_form" width="322" border="0" cellpadding="0" cellspacing="2" dir="rtl" style="margin-top:10px;font-family:ST;font-size:17">
                    	<tr>
                        <td width="110" height="20" align="right"><font class="form">&#1606;&#1575;&#1605; &#1705;&#1575;&#1585;&#1576;&#1585;&#1740; :</font></td>
                      
                        	<td width="160" height="20"><input name="username" type="text" class="form_login" id="username" /></td>
                        </tr>
                    	<tr>
<td width="110" height="20" align="right"><font class="form">&#1705;&#1604;&#1605;&#1607; &#1593;&#1576;&#1608;&#1585; :</font></td>

                        	<td width="160" height="20"><input name="password" type="password" class="form_login" id="password" /></td>
                        </tr>
                        <tr>
                       	  <td width="110" height="20" align="center"></td>
<td width="110" height="20" align="right"><input type="submit" value="&#1608;&#1575;&#1585;&#1583; &#1588;&#1608;&#1740;&#1583;" class="font" style="font-family:ST;font-size:15px" onClick="user_login();" />
                       	    <input name="Forms" type="hidden" id="Forms" value="user_login" /></td>
                        </tr>
                        <tr>
                            <td width="110" height="20">
<span class="forget"><a id="example1" href="reset_password.php">&#1576;&#1575;&#1586;&#1740;&#1575;&#1576;&#1740; &#1705;&#1604;&#1605;&#1607; &#1593;&#1576;&#1608;&#1585;</a></span>
                            </td>
                        </tr>
                        <tr>
              <td align="center" id="main_login" colspan="2" height="100"></td>
                        </tr>                    
                    </table>
</div></div>
</div>
<div class="middle">
<div class="info_box">
<div class="info_box_top">
  <div class="info_box_top_text">&#1570;&#1605;&#1575;&#1585; &#1608; &#1575;&#1591;&#1604;&#1575;&#1593;&#1575;&#1578;</div>
</div>
<div class="info_box_content">
<table width="304">
<tr>
<td width="146" class="info_td"><p>&#1578;&#1593;&#1583;&#1575;&#1583; &#1705;&#1575;&#1585;&#1576;&#1585;&#1575;&#1606;: </p></td>
<td width="146" style="text-align:center"><?php all_users() ?></td>
</tr>
<tr>
<td width="146" class="info_td"><p>&#1578;&#1593;&#1583;&#1575;&#1583; &#1705;&#1604; &#1587;&#1575;&#1740;&#1578; &#1607;&#1575;:</p></td>
<td style="text-align:center"><?php all_sites() ?></td>
</tr>
<tr>
<td width="146" class="info_td"><p>&#1578;&#1593;&#1583;&#1575;&#1583; &#1587;&#1575;&#1740;&#1578; &#1607;&#1575;&#1740; &#1601;&#1593;&#1575;&#1604; :</p></td>
<td style="text-align:center"><?php active_sites() ?></td>
</tr>
<tr>
<td width="146" class="info_td"><p>&#1576;&#1575;&#1586;&#1583;&#1740;&#1583; &#1607;&#1575;&#1740; &#1575;&#1605;&#1585;&#1608;&#1586;:</p></td>
<td style="text-align:center"><?php today_hit() ?></td>
</tr>
<tr>
<td width="146" class="info_td"><p>&#1576;&#1575;&#1586;&#1583;&#1740;&#1583; &#1607;&#1575;&#1740; &#1583;&#1740;&#1585;&#1608;&#1586;:</p></td>
<td style="text-align:center"><?php yesterday_hit() ?></td>
</tr>
<tr>
<td width="146" class="info_td"><p>&#1705;&#1575;&#1585;&#1576;&#1585;&#1575;&#1606; &#1570;&#1606;&#1604;&#1575;&#1740;&#1606;:</p></td>
<td style="text-align:center"><?php online_users() ?></td>
</tr>
<tr>
<td width="146" class="info_td"><p>&#1578;&#1593;&#1583;&#1575;&#1583; &#1705;&#1604; &#1576;&#1575;&#1586;&#1583;&#1740;&#1583; &#1607;&#1575;:</p></td>
<td style="text-align:center"><?php total_hit() ?></td>
</tr>
<tr>
<td width="146" class="info_td"><p>&#1583;&#1585;&#1570;&#1605;&#1583; &#1607;&#1575;&#1740; &#1608;&#1575;&#1585;&#1740;&#1586;&#1740;:</p></td>
<td style="text-align:center"><?php all_pays() ?> &#1578;&#1608;&#1605;&#1575;&#1606;</td>
</tr>

    </table>
</div>
</div>
<div class="info_box">
<div class="info_box_top">
  <div class="info_box_top_text">&#1705;&#1575;&#1585;&#1576;&#1585;&#1575;&#1606; &#1576;&#1585;&#1578;&#1585;</div>
</div>
<div class="info_box_content">
<table width="304">
<?php top_users(); ?>

    </table>
</div>
</div>
<div class="info_box">
<div class="info_box_top">
  <div class="info_box_top_text">&#1662;&#1588;&#1578;&#1740;&#1576;&#1575;&#1606;&#1740;</div>
</div>
<div class="auto-style1" style="padding-top:40px;font-family:ST;font-size:20;line-height:25px;color:red">
	<a alt="&#1662;&#1588;&#1578;&#1740;&#1576;&#1575;&#1606;&#1740;" href=" ymsgr:addfriend?aka3_ir" rel="follow" title="&#1662;&#1588;&#1578;&#1740;&#1576;&#1575;&#1606;&#1740;"><img src="http://basdid.tk/p.png" title="&#1662;&#1588;&#1578;&#1740;&#1576;&#1575;&#1606;&#1740;" alt="&#1662;&#1588;&#1578;&#1740;&#1576;&#1575;&#1606;&#1740;"></a>

</div>
</div>
</div>
<?php include"footer.php"; ?>

</body>
</html>
