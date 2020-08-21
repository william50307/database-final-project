<?php
    session_start(); 
	include("connMysql.php");
	$mid = $_SESSION['mid'];
	$pno = $_GET['pno'];
	$sql = "INSERT INTO favor (`mid`,`pno`) VALUES ($mid,$pno)";
    mysqli_query($db_link, $sql);
    echo "success!";
?>