<?php 
	//資料庫主機設定
	$db_host = "localhost";
	$db_username = "root";
	$db_password = "";
	//連線伺服器
	$db_link = @mysqli_connect($db_host, $db_username, $db_password);
	if (!$db_link) die("資料連結失敗！");
	//設定字元集與連線校對
	mysqli_set_charset($db_link, 'utf8');
	$seldb = @mysqli_select_db($db_link, "xprice");
	if (!$seldb) die("資料庫選擇失敗！");
?>