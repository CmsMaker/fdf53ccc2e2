<?php


$sec_id = rand(1111111,9999999);
	$ip = $_SERVER['REMOTE_ADDR'];
	if($db->sql_getrows("SELECT * FROM `sec_info` WHERE `username`='".$_SESSION['user']."'") > 0){
		
		$db->sql_query("DELETE FROM `sec_info` WHERE `username`='".$_SESSION['user']."'");
		$db->sql_query("INSERT INTO `sec_info` (sec_id,username,status,ip) VALUES ('$sec_id','".$_SESSION['user']."','0','$ip')");	
	}
	else{
	$db->sql_query("INSERT INTO `sec_info` (sec_id,username,status,ip) VALUES ('$sec_id','".$_SESSION['user']."','0','$ip')");	
	}
	
	
	
	$site_sec_id = rand(1111111,9999999);
	if($db->sql_getrows("SELECT * FROM `site_sec_info` WHERE `username`='".$_SESSION['user']."'") > 0){
		
		$db->sql_query("DELETE FROM `site_sec_info` WHERE `username`='".$_SESSION['user']."'");
		$db->sql_query("INSERT INTO `site_sec_info` (sec_id,username,status,ip) VALUES ('$site_sec_id','".$_SESSION['user']."','0','$ip')");	
	}
	else{
	$db->sql_query("INSERT INTO `site_sec_info` (sec_id,username,status,ip) VALUES ('$site_sec_id','".$_SESSION['user']."','0','$ip')");	
	}
	
?>
<head>
<title>بازدید - صفحه کسب درآمد</title>
<link rel="Shortcut Icon" href="favicon.png" type="image/x-icon" />
<style type="text/css" media="all">
@import url(launch.css);
</style>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" media="all" href="../bootstrap.css" />

<script src="../js/jquery-1.js"></script>
<script src="../js/bootstrap.js"></script>


 <script language="javascript" type="text/javascript">
var milisecTimer = 0;
var secondsTimer = 0;
var milisectTimer = 20;
var secondstTimer = 0;

function displayTimer()
{

    if (document.getElementById("Timer"))
    {
        if (document.getElementById("Timer").value != "--:--")
        {
            if ((milisectTimer == 1 && secondstTimer == 0) || secondstTimer < 0)
            {
                document.getElementById("Timer").value = "--:--";

                window.open("<?php echo "a_surf.php?sec_id=$sec_id"; ?>","_self");
            }
            else if (milisectTimer == 0)
            {
                milisectTimer = 20;
                secondstTimer = 0;
            }


            milisectTimer -= 1;

            if (document.getElementById("Timer").value != "--:--") {

                if (milisectTimer >= 10)
                    document.getElementById("Timer").value = "0" + secondstTimer + ':' + milisectTimer;
                else
                    document.getElementById("Timer").value = "0" + secondstTimer + ':' + "0" + milisectTimer;

                setTimeout("displayTimer()", 1000);
            }

            bgColor = "#BBE88F";
            if(secondstTimer < 2)
                 bgColor = "#F8BCB6";
            else if(secondstTimer < 5)
                bgColor = "#EDEF73";

            document.getElementById("Timer").style.backgroundColor = bgColor;

        }
    }
}

</script>



<script type="text/javascript">var maxseconds='18';var Zeit='18';var durch=0;function doTime()
{if(Zeit>0)
{Zeit--;$('#countdown').html(Zeit);var percent=Zeit/maxseconds*100;$('#progress').css('width',percent+'%');active=setTimeout('doTime()',1000);}

if(Zeit==0)
{durch++;try
{efl.close();Zeit='0';}
catch(err)
{try
{if(efl.closed)
{$('#messages').html();}
else
{$('#messages').html();}}
catch(err)
{}}}
else
{active=setTimeout('doTime()',18000);}}
function close_window(){if(confirm("Close Window?"))
{efl.close();close();}}
function openLinkClosePopup(url)
{setTimeout(function waiting(){efl=window.open(url,'_blank');efl.location="go.php?sec_id=<?php echo $site_sec_id; ?>";},"1000");}
$(function(){doTime();openLinkClosePopup('go.php?sec_id=<?php echo $site_sec_id; ?>')});</script>
</head>
 
<center>
<div class="bazdidsaz_timer">
<div class="timer_block">
لذت یک درآمد اینترنتی آسان و واقعی
<br>
<br>

<?php
	switch($data['level']){
		
		case"1";
		$user_cost = $bronze_user_cost;
		break;
		case"2";
		$user_cost = $silver_user_cost;
		break;
		case"3";
		$user_cost = $golden_user_cost;
		break;
	}
?>

				            مبلغ <?php echo $user_cost; ?> ریال بعد از <input value="10:00" style="background-color: #BBE88F;margin-top:1px;width: 55px;border-style: solid;border-width: 1px;border-color: #CECECE;text-align:center;font-family:FONT;font-size:20px " name="Timer" id="Timer" readonly="true" tabindex="-1">
<Script language="JavaScript">
    displayTimer();
</Script> ثانیه
<br>				
<br>
<br>
درآمد شما : <?php echo $data['mony']; ?> ریال
<br>
<br>
بازدید امروز : <?php echo $data['today_hit']; ?>
</div>
</div>
</center>

<body></body>
