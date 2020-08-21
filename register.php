<?php
	session_start();
	//無效信箱
	if(!$_POST['valid']){
		echo ("<script>alert('該信箱已被使用!');</script>");
		exit(0);
	}
	//收驗證信
	if(isset($_POST['getcode'])){
		include("mailapply/sendmail.php");
		echo ("<script>alert('已送出驗證信件，請至信箱查收');</script>");
	}
	//註冊
	else{
		if($_SESSION['code'] != $_POST['code']){
			echo ("<script>alert('驗證碼錯誤!');</script>");
		}
		else{
			include("connMysql.php");
			$name = $_POST['name'];
			$mail = $_POST['mail'];
			$password = $_POST['password'];
			$confirm = $_POST['password-confirm'];
			$phone = $_POST['phone'];
			
			if($password != $confirm){
				echo "<script>alert('確認密碼有誤!');</script>";
			}
			else if(strlen($password)<8){
				echo "<script>alert('密碼長度不得小於8');</script>";
			}
			else{
				$sql_query = "INSERT INTO `member` (`name` ,`password` ,`phone` ,`mail`) VALUES ('$name','$password','$phone','$mail')";
				$result = mysqli_query($db_link, $sql_query);
				if($result){
					echo "<script>alert('註冊成功'); location.href = 'login.html';</script>";
				}
				else{
					echo "<script>alert('something wrong!');</script>";
				}
			}
			
		}
	}
?>