<?php include"header.php"; ?>


<div class="middle">
<?php include"rsidebar.php"; ?>

<div class="post_box">
<div class="post_box_top">
  <div class="post_box_top_text">قوانین سایت</div>
</div>
<div class="post_box_content">

<?php
 $db->sql_query("SELECT * FROM `pages`");
 $details = $db->sql_fetcharray();
 
 echo $details['rule'];
?>

</div>
</div>
</div>
</div>
<?php include"footer.php"; ?>


</body>
</html>
