<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Xprice</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<!--引用jQuery-->
<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

<!--引用dataTables.js-->
<script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>

<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css">


	
</head>
<body>
	<div class="frame">

		<h2 align="center">Xprice管理登入</h2>

		<div class="container">
        <form method="post" action="">
            <div class="form-group">
                <label>account</label>
                <input type="text" class="form-control" name="account" id="account">
            </div>
            <div class="form-group">
                <label>password</label>
                <input type="password" class="form-control" name="password" id="password">
            </div>
            <button type="submit" class="btn btn-info btn-block" name="action" value="login">登入</button>
        </form>
    	</div>
	
		<?php
		if(isset($_POST["action"])&&($_POST["action"]=="login")){
			session_start();
			$account = $_POST["account"];
			$password = $_POST["password"];
			//connect the database
			//header("Content-Type: text/HTML; charset=utf-8");
			include("connMysql.php");

			$sql = "SELECT * FROM `admin` WHERE `account`='$account'";
			$result=mysqli_query($db_link, $sql);
			if(!$result) die('無此帳號');
			$row = mysqli_fetch_assoc($result);

			if($account != NULL && $password!= NULL && $row["account"] == $account && $row["password"] == $password){
				//將帳號寫入session
				$_SESSION['username'] = $account;
			    header("Location:admin.php");
			}
			else
			{
				echo '<script>alert("帳號或密碼錯誤")</script>';
			    echo '<meta http-equiv=REFRESH CONTENT=1;url=adminlogin.php>';
			}
		}
		
		?>
		</div>
</body>
</html>