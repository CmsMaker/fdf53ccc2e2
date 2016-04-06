<?php
include "../../../config.php";
include "../../../include/jdf.php";
include "../../../include/mysql.class.php";
$db = new Mysql($host,$dbuname,$dbpass,$dbname,false);
$db->Database_Connect();

$db->sql_query("SELECT * FROM `ticket` WHERE `id`='".$_POST['id']."'");
$fetch = $db->sql_fetcharray();
$db->sql_query("UPDATE `ticket` SET `status`='1' WHERE `id`='".$_POST['id']."'");

?>
<table border="0" style="border:#ACACAC solid 1px;float:right;margin-bottom:10px">
<tr>

<td width="662"  style="font-size:12px;font-weight:bold;padding-right:5px" height="20" bgcolor="#E4E4E4" align="right"><?php echo $fetch['title']; ?></td>
</tr>
<tr>
<td width="662" height="20" align="center">
<div style="width:630;text-align:right;font-size:12px">
<?php echo $fetch['text']; ?>
</div>
</td>
</tr>
</table>