<?php
    require 'PHPMailer-master/src/PHPMailer.php';
	require 'PHPMailer-master/src/Exception.php';
	require 'PHPMailer-master/src/SMTP.php';

    $mail= new PHPMailer\PHPMailer\PHPMailer();    //建立新物件
    //$mail->SMTPDebug = 2;
    $mail->SMTPOptions = array(
       'ssl' => array(
       'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
         )
    );

    $mail->IsSMTP();                               //設定使用SMTP方式寄信
    $mail->SMTPAuth = true;                        //設定SMTP需要驗證
    $mail->SMTPSecure = "ssl";                     // Gmail的SMTP主機需要使用SSL連線
    $mail->Host = "smtp.gmail.com";                //SMTP主機
    $mail->Port = 465;                             //SMTP主機的埠號(Gmail為465)。
    $mail->CharSet = "utf-8";                      //郵件編碼
    $mail->Encoding = "base64";
    $mail->Username = "mywebdemomail";             //帳號
    $mail->Password = "s123456789+";               //密碼
?>

