<?php
	session_start();
	$mid = $_SESSION["mid"];
	include("connMysql.php");
	if(isset($_POST['action'])){
		$name = $_POST["name"];
		$mail = $_POST["mail"];
		$phone = $_POST["phone"];
    	$sql = "UPDATE member SET name = '$name',  
            mail = '$mail', phone = '$phone' WHERE mid = $mid";
		$result = mysqli_query($db_link, $sql);
		echo("<script>alert('修改成功!');location.href='index.php'</script>");
	}
	$sql = "SELECT * FROM member Where mid = $mid";
	$result = mysqli_query($db_link, $sql);
	$row = mysqli_fetch_assoc($result);
?> 

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Xprice</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
	<link href="index_css.css" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+TC:wght@900&display=swap" rel="stylesheet">
</head>
<body>
	<!-- 導覽列 -->
	<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #FFEED6;">
		<a class="nav-link dropdown" href="#" id="#multiCollapseExample1" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="navbar-toggler-icon"></span></a>
		<div class="dropdown-menu" aria-labelledby="#multiCollapseExample1">
			<a class="dropdown-item" href="login.html"><img class="rounded-circle" src="images.jpg" style="width:40px;height:40px">TEST_NAME</a>
			<a class="dropdown-item" href="#">● 我的收藏</a>
			<a class="dropdown-item" href="兌換中心.html">● 點數中心</a>
			<a class="dropdown-item" href="會員中心.html">● 會員中心</a>
		</div>
		<a class="navbar-brand" href="#"><img src="icon/Xprice.png" width="40%" style="margin-top: -5%; margin-bottom: -5%"></a>
  		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon">
		</button>
  		<div class="collapse navbar-collapse"  id="navbarSupportedContent">
    		<ul class="navbar-nav ml-auto">
      			<li class="nav-item dropdown" >
        			<a class="nav-link dropdown" href="#" id="product" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Product</a>
					 <div style="width:315px;border-radius:60px;background-color:#AAAAAA;padding-left:10px" class="dropdown-menu" aria-labelledby="navbarDropdown">
						<div id="pp">
							<div id="p1" class="kk">
							</div>
						</div>
						
				</li>
      			<li class="nav-item dropdown">
        			<a class="nav-link" href="#">Sale</a>
      			</li>
    		</ul>
		</div>
	</nav>

	<!-- 搜尋列 -->
	<div class="container" style="margin-top: 2%;">
			<div class="col align-self-center form-inline justify-content-center">
				<img src="icon/Xprice.png" width="10%" style="margin-right: 2% ">
				<input type="search" class="form-control col-md-7"  placeholder="想找什麼?">
				<button class="btn btn-outline-secondary my-2 my-sm-0" type="submit" style="margin-left: 2%">Search</button>
			</div>
	</div>
	<form action="" method="POST" name="modify">
	<div class="container my-5" >
		<div class="row align-items-center justify-content-center rounded" >
			<div class="col-6 "  style="background-color: #EDEDED ;">
				<div class="col-12 justify-content-start mt-2 d-flex align-self-end">
						<img src="icon/register.svg" class="d-flex align-self-center" width="15%">
						<span class=" mt-2" style="font-size:48px;text-decoration:underline;" >會員資料修改</span>

				</div>			
				<div class="col-12 my-3">
					<label for="name" class="h5 font-weight-bold">姓名</label>
	  				<input type="name" class="form-control" name="name" id="name" aria-describedby="emailHelp" placeholder="姓名" value="<?php echo $row['name']?>">
  				</div>
  				<div class="col-12 my-3">
   					<label for="mail" class="h5 font-weight-bold">E-mail</label>
    				<input type="email" class="form-control" name="mail" id="mail" placeholder="Email" value="<?php echo $row['mail'] ?>">
  				</div>
  				<div class="col-12 my-3">
   					<label for="phone" class="h5 font-weight-bold">電話</label>
    				<input type="phone" class="form-control" name="phone" id="phone" placeholder="電話" value="<?php echo $row['phone'] ?>">
  				</div> 
  				<div class="button text-center mt-4" style="padding-bottom:10%">
					<!-- <button type="button" class="btn btn-light  btn-outline-secondary mx-2">註冊</button> -->
					<input type="submit" id="action" name="action" class="btn btn-light  btn-outline-secondary mx-2" value="儲存修改">
				</div>
			</div>
		</div>
	</div>
	</form>
</body>
</html>