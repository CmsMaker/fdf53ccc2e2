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
  <div class="post_box_top_text">سیستم بهبود رتبه الکسا و کسب درآمد به ازای بازدید</div>
</div>
<div class="post_box_content">
  <p style="font-family:ST;font-size:16px;padding-top:15px;line-height:30px">به سامانه کسب درآمد و بهبود رتبه الکسای ما خوش آمدید.
  <br>در صورتی که برای اولین بار وارد سایت ما می شوید و میخواهید از امکانات سایت ما استفاده نمائید، تقاضا می کنیم ابتدا صفحات سوالات متداول و قوانین را مطالعه نمائید تا بهتر بتوانید از خدمات ما استفاده نمائید.<br />
  تعرفه های سیستم :<br />
  هزینه هر بازدید از سایت شما:  <?php echo $hit_cost; ?> ریال<br />
  پورسانت کاربر برنزی به ازای هر بازدید : <?php echo "$bronze_user_cost"; ?> ریال
  <br />
  پورسانت کاربر نقره ای به ازای هر بازدید : <?php echo "$silver_user_cost"; ?> ریال
  <br />
  پورسانت کاربر طلایی به ازای هر بازدید : <?php echo "$golden_user_cost"; ?> ریال
  <br />
  پورسانت شما به ازای هر بازدید زیرمجموعه : <?php echo $from_refer; ?> درصد از پورسانت سطح کاربری خود شما
  <br />
  هزینه فعال سازی زیرمجموعه گیری - همیشگی : <?php echo $refering_activation; ?> ریال
  <br />
  هزینه سطح کاربری نقره ای - ماهیانه : <?php echo $level_silver_cost; ?> ریال
  <br />
  هزینه سطح کاربری طلایی - ماهیانه : <?php echo $level_golden_cost; ?> ریال
  
  
  </p>



</div>
</div>
</div>
</div>



<script type="text/javascript">
var count_messages = <?php echo (tickets()); ?>;
	if(count_messages > "0")
	{
		if(confirm("<?php echo (tickets()); ?> پيام جديد داريد مي خواهيد آنها را بخوانيد"))
		{
			window.location="ticket_list.php";
		}

	}
</script>




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