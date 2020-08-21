<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>send apply email</title>
</head>
<body>	
<?php
	if (isset($_POST['getcode'])){
		include("mail_set.php"); 
	    $code = rand(10000,99999);
	    $_SESSION['code'] = $code;
  		$body = '驗證碼:'.$code;
		//使用者收到管理員回覆的信	
		$C_email = $_POST['mail'];
		$C_message = $body;
		$mail->From = "mywebdemomail@gmail.com";        //寄件者信箱	
	    $mail->FromName = "mywebdemomail";              //寄件者姓名
	    $mail->Subject ="信箱認證";          		    //郵件標題
	    $mail->Body = $C_message; 						//郵件內容
	    $mail->IsHTML(true);                            //郵件內容為html
	    $mail->AddAddress($C_email);            		//收件者郵件及名稱
	    $mail->addBCC('mywebdemomail@gmail.com');		//寄件者信箱
		if(!$mail->Send()){
			echo "Error: " . $mail->ErrorInfo;
		}
	}
	if(isset($_POST['confirm'])){
		include("mail_set.php"); 
		$body = "您的商品回報已被認證<br>";
		$body .= "獲得50X幣,請至會員中心查收";
		//使用者收到管理員回覆的信	
		$C_email = $_POST['mail'];
		$C_message = $body;
		$mail->From = "mywebdemomail@gmail.com";        //寄件者信箱	
	    $mail->FromName = "mywebdemomail";              //寄件者姓名
	    $mail->Subject ="商品價格回報已認證";            //郵件標題
	    $mail->Body = $C_message; 						//郵件內容
	    $mail->IsHTML(true);                            //郵件內容為html
	    $mail->AddAddress($C_email);            		//收件者郵件及名稱
	    $mail->addBCC('mywebdemomail@gmail.com');		//寄件者信箱
		if(!$mail->Send()){
			echo "Error: " . $mail->ErrorInfo;
		}
	}	
?>
</body>
 
</html>