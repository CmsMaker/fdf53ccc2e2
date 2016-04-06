<?php include"header.php"; ?>


<div class="middle">
<?php include"rsidebar.php"; ?>

<div class="post_box">
<div class="post_box_top">
  <div class="post_box_top_text">سوالات متداول</div>
</div>
<div class="post_box_content">

<?php 
$db->sql_query("SELECT * FROM `faq` ORDER BY id ASC");
while($news = $db->sql_fetcharray()){

?>
<div class="faq_td"><a id="example1" href="faq_read.php?id=<?php echo $news['id'] ?>"><?php echo $news['title'] ?></a></div>
<?php } ?>
</div>
</div>
</div>
</div>
<?php include"footer.php"; ?>


</body>
</html>
