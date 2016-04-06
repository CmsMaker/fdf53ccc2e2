<?php
if ( isset($_SESSION['user']) ) {
include "data/function.php";


$timestamp = time() + 600;

$db->sql_query("UPDATE `user` SET timestamp='".$timestamp."' WHERE `username`='".$_SESSION['user']."'");

today();
?>
<html>
<head>
<title>پنل کاربری</title>
<link rel="Shortcut Icon" href="favicon.png" type="image/x-icon" />
<meta name="description" content="سامانه بهبود رتبه الکسا و کسب درامد به ازای بازدید حرفه ای,ارسال بازدید با جدیدترین روش" />
<link rel="canonical" href="http://www.20script.ir" />
<meta name="keywords" content="رتبه الکسا,بهبود رتبه الکسا,کسب درآمد اینترنتی,کسب درآمد به ازای بازدید,خرید آی پی ایرانی,خرید بازدید هدفمند,افزایش آمار واقعی,افزایش آمار هدفمند" />
<style type="text/css" media="all">
@import url(style.css);
</style>
<meta charset="utf-8">
<script src="data/js/ajax.js" type="text/javascript"></script>
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
				'height'			: '100%',
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
    	<li><a href="../index.php" class="home" target="_blank"><span>صفحه اصلی</span></a>
        </li>
<li><a href="../faq.php" class="help" target="_blank"><span>سوالات متداول</span></a> </li>
    	<li><a href="../rules.php" class="about" target="_blank"><span>قوانین</span></a></li>
        <li><a href="../pays.php" class="help" target="_blank"><span>لیست پرداختی ها</span></a></li>
    	<li><a href="../contact.php" class="contact" target="_blank"><span>ارتباط با ما</span></a></li>
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
<?php } ?>