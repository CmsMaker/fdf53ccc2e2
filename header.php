<?php
include "config.php";
include "include/jdf.php";
include "include/mysql.class.php";
include "include/function/function.php";
$db = new Mysql($host,$dbuname,$dbpass,$dbname,false);
$db->Database_Connect();

today();
if(isset($_GET['refer'])){
	$refer = $_GET['refer'];
}

?>
<html>
<head>
<!-- www.20script.ir -->
<title>کسب درآمد به ازای بازدید - بهبود حرفه ای رتبه الکسا</title>
<link rel="Shortcut Icon" href="favicon.png" type="image/x-icon" />
<meta name="description" content="دانلود رایگان اسکریپت بازدید ساز فارسی" />
<meta name="keywords" content="سرور,هاستینگ,فروش هاست,هاست امن,سرور مجازی,پشتیبانی,امنیت لینوکس,سیپنل,سرور اختصاصی,مدیریت سرور,خرید هاست,میزبان سایت,ثبت دامنه,هاست ارزان,هاست قدرتمند,هاست قوی" />
<link rel="canonical" href="http://www.20script.ir" />
<style type="text/css" media="all">
@import url(style.css);
</style>
<meta charset="utf-8">
<script src="data/user/js/ajax.js" type="text/javascript"></script>
	<script type="text/javascript">
$(document).ready(function () {	
	
	$('#nav li').hover(
		function () {
			//show its submenu
			$('ul', this).slideDown(500);

		}, 
		function () {
			//hide its submenu
			$('ul', this).slideUp(100);			
		}
	);
	
});
</script>
    <script type="text/javascript" src="js/jcarousellite_1.0.1.min.js" charset="utf-8"></script>


<style type="text/css">
 #loading-visible {
	 background:url(data/user/ajax/load.gif);
	 height:100px;
	 width:100px;
 }
</style>

<!-- ٍBegin fancybox -->

	<script>
		!window.jQuery && document.write('<script src="js/fancybox/jquery-1.4.3.min.js"><\/script>');
	</script>
	<script type="text/javascript" src="js/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
	<script type="text/javascript" src="js/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
	<link rel="stylesheet" type="text/css" href="js/fancybox/jquery.fancybox-1.3.4.css" media="screen" />
	<script type="text/javascript">
		$(document).ready(function() {
			/*
			*   Examples - images
			*/

			$("a#example1").fancybox();

			$("a#example2").fancybox({
				'overlayShow'	: false,
				'transitionIn'	: 'elastic',
				'transitionOut'	: 'elastic'
			});

			$("a#example3").fancybox({
				'transitionIn'	: 'none',
				'transitionOut'	: 'none'	
			});

			$("a#example4").fancybox({
				'opacity'		: true,
				'overlayShow'	: false,
				'transitionIn'	: 'elastic',
				'transitionOut'	: 'none'
			});

			$("a#example5").fancybox();

			$("a#example6").fancybox({
				'titlePosition'		: 'outside',
				'overlayColor'		: '#000',
				'overlayOpacity'	: 0.9
			});

			$("a#example7").fancybox({
				'titlePosition'	: 'inside'
			});

			$("a#example8").fancybox({
				'titlePosition'	: 'over'
			});

			$("a[rel=example_group]").fancybox({
				'transitionIn'		: 'none',
				'transitionOut'		: 'none',
				'titlePosition' 	: 'over',
				'titleFormat'		: function(title, currentArray, currentIndex, currentOpts) {
					return '<span id="fancybox-title-over">Image ' + (currentIndex + 1) + ' / ' + currentArray.length + (title.length ? ' &nbsp; ' + title : '') + '</span>';
				}
			});

			/*
			*   Examples - various
			*/

			$("#various1").fancybox({
				'titlePosition'		: 'inside',
				'transitionIn'		: 'none',
				'transitionOut'		: 'none'
			});

			$("#various2").fancybox();

			$("#various3").fancybox({
				'width'				: '75%',
				'height'			: '75%',
				'autoScale'			: false,
				'transitionIn'		: 'none',
				'transitionOut'		: 'none',
				'type'				: 'iframe'
			});

			$("#various4").fancybox({
				'padding'			: 0,
				'autoScale'			: false,
				'transitionIn'		: 'none',
				'transitionOut'		: 'none'
			});
		});
	</script>
        <!-- ٍEnd fancybox -->
</head>
<body>


<div class="top">
<div class="middle">

<div class="top_menu">
    	<ul id="nav">
    	<li><a href="index.php<?php if (isset($refer)) {echo("?refer=$refer"); }?>" class="home"><span>صفحه اصلی</span></a>
        </li>
	<li><a href="register.php<?php if (isset($refer)) {echo("?refer=$refer"); }?>" class="shop"><span>عضویت</span></a></li>
<li><a href="faq.php<?php if (isset($refer)) {echo("?refer=$refer"); }?>" class="help"><span>سوالات متداول</span></a> </li>
    	<li><a href="rules.php<?php if (isset($refer)) {echo("?refer=$refer"); }?>" class="about"><span>قوانین</span></a></li>
        <li><a href="pays.php<?php if (isset($refer)) {echo("?refer=$refer"); }?>" class="help"><span>لیست پرداختی ها</span></a></li>
    	<li><a href="contact.php<?php if (isset($refer)) {echo("?refer=$refer"); }?>" class="contact"><span>ارتباط با ما</span></a></li>
    </ul><!--Navigation-->
</div>

</div><!--Middle-->
</div><!--Top-->

<div class="back_02"><div class="top_shadow">
<div class="middle">

<div class="header"></div><!--Header-->



</div><!--Middle-->
</div></div><!--Back 2-->
<div class="bar"></div>