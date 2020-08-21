<?php
	if (!isset($_SESSION['username'])){
		echo "<script>alert('連線錯誤，請重新登入'); location.href = 'adminlogin.php';</script>";
	}
?>