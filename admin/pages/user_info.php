<?php
session_start();
if ( isset($_SESSION['admin']) ) {
include"../../config.php";
include"../../include/mysql.class.php";
$db = new Mysql($host,$dbuname,$dbpass,$dbname,false); //create database object
$db->Database_Connect(); //connect to database

 if ( isset($_GET['id']) ) {
	
	$id = $_GET['id'];
	$db->sql_query("SELECT * FROM `user` WHERE `id`=$id");
	$fetch = $db->sql_fetcharray();
	
	
	switch($fetch['level']){
		case"1";
		$level = "برنزی";
		break;
		case"2";
		$level = "نقره ای";
		break;
		case"3";
		$level = "طلایی";
		break;
	}
	switch($fetch['refering']){
		case"0";
		$refering = "غیرفعال";
		break;
		case"1";
		$refering = "فعال";
		break;
	}
	
	
	$bank_id = $fetch['bank_name'];
	if($bank_id !==""){
	$db->sql_query("SELECT * FROM `bank_name` WHERE `id`=$bank_id");
	$bank = $db->sql_fetcharray();
	}
?><head>
<script src="data/js/ajax.js" type="text/javascript"></script>
<script src="data/ajax/ajax.js" type="text/javascript"></script>
</head>
<meta charset="utf-8">
<table width="400" border="0" cellspacing="10"  dir="rtl" id="status" style="font-family:tahoma;font-size:12px">
 <tr>
        	<td align="center" id="main" colspan="2"></td>
        </tr>
         <tr>
      <td width="110" height="20" align="right" class="info_td">نام و نام خانوادگی</td>
        	<td width="198" height="20" align="right"><?php echo $fetch['name']; ?></td>
        	
        </tr>
         <tr>
        <td width="110" height="20" align="right" class="info_td">نام کاربری</td>
        	<td width="198" height="20" align="right"><?php echo $fetch['username']; ?></td>
        	
        </tr>
         <tr>
        <td width="110" height="20" align="right" class="info_td">آدرس ایمیل</td>
        	<td width="198" height="20" align="right"><?php echo $fetch['email']; ?></td>
        	
        </tr>
         <tr>
        <td width="110" height="20" align="right" class="info_td">شماره موبایل</td>
        	<td width="198" height="20" align="right"><?php echo $fetch['mobile']; ?></td>
        	
        </tr>
        <tr>
        <td width="110" height="20" align="right" class="info_td">سطح کاربری</td>
        	<td width="198" height="20" align="right"><?php echo $level; ?></td>
        	
        </tr>
        <tr>
        <td width="110" height="20" align="right" class="info_td">امکان زیرمجموعه گیری</td>
        	<td width="198" height="20" align="right"><?php echo $refering; ?></td>
        	
        </tr>
        <tr>
        <td width="110" height="20" align="right" style="border-bottom:1px solid #F00" class="info_td">تاریخ عضویت</td>
        	<td width="198" height="20" align="right"  style="border-bottom:1px solid #F00"><?php echo $fetch['reg_date']; ?></td>
        	
        </tr>
 <tr>
        <td width="110" height="20" align="right" class="info_td">شماره حساب</td>
        	<td width="198" height="20" align="right"><?php echo $fetch['bank_number']; ?></td>
        	
        </tr>
        <tr>
        <td width="110" height="20" align="right" class="info_td">شماره کارت</td>
        	<td width="198" height="20" align="right"><?php echo $fetch['bank_cart']; ?></td>
        	
        </tr>
         <tr>
        <td width="110" height="20" align="right" class="info_td">شماره شبا</td>
        	<td width="198" height="20" align="right"><?php echo $fetch['bank_shaba']; ?></td>
        	
        </tr>
         <tr>
        <td width="110" height="20" align="right" class="info_td">صاحب حساب</td>
        	<td width="198" height="20" align="right"><?php echo $fetch['bank_owner']; ?></td>
        	
        </tr>
         <tr>
        <td width="110" height="20" align="right"  style="border-bottom:1px solid #F00" class="info_td">نام بانک</td>
        	<td width="198" height="20" align="right"  style="border-bottom:1px solid #F00"><?php echo $bank['bank_name']; ?></td>
        	
        </tr>
         <tr>
        <td width="110" height="20" align="right" class="info_td">موجودی حساب</td>
        	<td width="198" height="20" align="right"><?php echo $fetch['credit']; ?> بازدید</td>
        	
        </tr>
         <tr>
        <td width="110" height="20" align="right" class="info_td">میزان درآمد</td>
        	<td width="198" height="20" align="right"><?php echo $fetch['mony']; ?> ریال</td>
        	
        </tr>
         <tr>
        <td width="110" height="20" align="right" class="info_td">بازدید امروز</td>
        	<td width="198" height="20" align="right"><?php echo $fetch['today_hit']; ?></td>
        	
        </tr>
         <tr>
        <td width="110" height="20" align="right" class="info_td">بازدید دیروز</td>
        	<td width="198" height="20" align="right"><?php echo $fetch['yesterday_hit']; ?></td>
        	
        </tr>
         <tr>
        <td width="110" height="20" align="right" class="info_td">بازدید کل</td>
        	<td width="198" height="20" align="right"><?php echo $fetch['total_hit']; ?></td>
        	
        </tr>
      </table>
      <?php 
	  
	  }
else {
	header("Location:../index.php");
	}
	  
	  } ?>
