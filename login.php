<?php
	if(isset($_POST["action"])&&($_POST["action"]=="login")){
		session_start();
		include("connMysql.php");
		$account = $_POST["mail"];
		$password = $_POST["password"];
		$sql = "SELECT * FROM `member` WHERE `mail`='$account'";
		$result=mysqli_query($db_link, $sql);
		if(!$result) die('無此帳號');
		$row = mysqli_fetch_assoc($result);

		if($account!= NULL && $password!= NULL && $row["mail"] == $account && $row["password"] == $password){
			//將mid寫入session
			$_SESSION['mid'] = $row['mid'];
			echo "<script>window.location.href='index.php';</script>";
		}
		else
		{
			echo '<script>alert("帳號或密碼錯誤")</script>';
		}
	}
?>