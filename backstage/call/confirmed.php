<?php
	include("connMysql.php");
    $sql = "UPDATE `form` SET confirmed = 1 WHERE `fid` =".$_GET["fid"];     
    $result = mysqli_query($db_link, $sql);
?>