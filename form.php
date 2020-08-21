<!DOCTYPE html>
<html>
<?php
session_start();
if(!isset($_SESSION['mid'])){
	echo "<script>alert('請先登入!'); location.href = 'login.html'</script>";
}
include("connMysql.php");
$sql="SELECT product.pname,store.sname,product.img
	  FROM supplyed, store, product
	  WHERE supplyed.sid = store.sid AND supplyed.pno = product.pno 
	  AND supplyed.sid =".$_GET['sid']." AND product.pno=".$_GET['pno'];
	$result = mysqli_query($db_link, $sql);
	$r=mysqli_fetch_assoc($result);

if (isset($_POST["action"])){
	$pno = $_GET["pno"];
    $pname = $_POST["pname"];
    $sid = $_GET["sid"];
	$price = $_POST["price"];
	$img = "0x".bin2hex(fread(fopen($_FILES["file"]["tmp_name"], "r"), filesize($_FILES["file"]["tmp_name"])));

	$sql_query = "INSERT INTO `form` (`pno` ,`sid` ,`img` ,`newprice`) VALUES ('$pno','$sid',$img,'$price')";
	mysqli_query($db_link, $sql_query);
	$sql = "SELECT * FROM `form`  ORDER BY fid DESC LIMIT 0, 1";//取得最後一筆回報的fid
	$result = mysqli_query($db_link, $sql);
	$r=mysqli_fetch_assoc($result);
	$fid = $r['fid'];

	$sql_query = "INSERT INTO `writed` (`mid`, `fid`) VALUES ('".$_SESSION['mid']."','$fid')";
	mysqli_query($db_link, $sql_query);

    echo "<script>alert('已收到您的回報!'); location.href = history.go(-2);</script>";
}
?>
<head>
<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="icon/X.png" type="image/x-icon" />
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<title>Xprice</title>
	
	<!-- Icon css link -->
	<link href="css/font-awesome.min.css" rel="stylesheet">
	<!-- Bootstrap -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<!-- Extra plugin css -->
	<link href="css.css" rel="stylesheet" type="text/css">
	<link href="css/style.css" rel="stylesheet">
	<!-- font-family -->
	<script src="https://kit.fontawesome.com/04ee868bb6.js" crossorigin="anonymous"></script>
	<link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@700&family=Noto+Sans+TC:wght@400;900&family=Noto+Serif+TC:wght@600&family=Oswald:wght@500&display=swap" rel="stylesheet">
</head>
<script>
	//檢查是否登入
	$(document).ready(function(){ 
		$.ajax({
			type: "POST",
			url: "iflogin.php",
			data: {},
			dataType: 'html'
		}).done(function(data) {
			$('#nav').append(data);
			console.log(data);
		}).fail(function(jqXHR, textStatus, errorThrown) {
			alert("something wrong");
			console.log(jqXHR.responseText);
		});
	});
</script>
<body>
<header class="main_menu_area " style="background-color: #000000a1;height: 15%">
            <nav class="navbar navbar-expand-lg navbar-secondary bg-secondary">
              <a class="navbar-brand" href="index.php"><img src="icon/Xprice.png" width="50%" alt=""></a>
              <button class="navbar-toggler " type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-sliders-h text-white fa-2x"></i>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav" id='nav'>
                      <li class="nav-item"><a class="nav-link" href="promotions.html">特價專區</a></li>
                      <li class="nav-item"><a class="nav-link" href="map.html">搜尋店面</a></li>
                    </ul>
                </div>
            </nav>
        </header>
<form aciton="#" method="GET">
		<div>
			<div class="row align-items-center form-inline justify-content-center background" >
				<p class="col-12 text-center text-white h1 " style="font-family: 'Noto Serif TC', serif; padding-top: 8%">最便宜、最優惠的價格都在  Xprice</p>
				<p class="col-12 text-center h3 text-white"  style="font-family: 'Oswald', sans-serif;">Give you the cheapest price</p>
				<img src="icon/Xprice.png" width="10%" style="margin-right: 2% ">
				<input type="hidden" name='store_order' value=''>
				<input type="hidden" name='data_num' value=''>
				<input type="hidden" name='price_order' value=''>
				<input type="search"  name='search' class="form-control  col-md-7"  placeholder="想找什麼?">
				<button class="btn my-2 my-sm-0 btn" type="submit" style="margin-left: 2% ; background-color:#000000a1;color: #fff">Search</button>
			</div>
		</div>
	</form>
	
	<div class="container my-5" >
	<div class="row align-items-center justify-content-center rounded" >
	<div class="text-left border border-light p-5 col-6" style="background-color:#EDEDED">
	
	<form method="POST" action="" name="form1" Enctype="multipart/form-data">
		<h1 style="font-size:48px;text-decoration:underline; margin:3% 0 5% 0" >
		<img src="icon/money.svg" width="15%"></img>價格回報
		</h1>

		<div class="form-group">
		<label for="exampleInputEmail1" class="h5 font-weight-bold">商品名稱</label>
        <textarea name="pname" class="form-control rounded-0" id="pname" rows="1" required="required" ><?php echo $r['pname'] ?></textarea>
		</div>
		<div class="form-group">
        <img class="d-inline w-50 border rounded border-secondary" src=<?php echo $r['img']?>>
		</div>
		<div class="form-group">
		<label for="exampleInputEmail1" class="h5 font-weight-bold">商店</label>
        <input disabled class="form-control rounded-0" value="<?php echo $r['sname']?>">
		</div>
		<div class="form-group">
		<label for="price" class="h5 font-weight-bold">商品價格</label>
        <input type="text" name="price" class="form-control rounded-0" id="price" rows="1" placeholder="商品價格"  required="required" >
		</div>
		<label for="exampleInputEmail1" class="h5 font-weight-bold">上傳商品價格圖片</label>
		<div class="form-control mb-4">
			<input name="file" type="file" accept="image/gif, image/jpeg, image/png" id="file">
		</div>
		<div class="button text-center mt-4" >
			<input class="btn btn-light  btn-outline-secondary mx-2" type="submit" value="送出" name="action" >
		</div>
	</form>
	
	</div>
	</div>
	</div>

	<footer class="bg-dark  mt-5">
           <div class="container " >
              <div class="row align-items-center" style="padding: 5% 0">
                <div class="col-3 align-self-center text-center" >
                  <img src="icon/Xprice.png" width="70%">

                </div>
                <div class="col-5 text-white" style="font-family: 'Noto Serif TC', serif;">
                    <p class="my-3 h5"> <i class="fas fa-phone"></i>      Phone：07-1234567</p>
                    <h5 class="my-3 "> <i class="fas fa-map-marker-alt"></i>         Address：高雄市鼓山區蓮海路70號</h5>
                    <h5 class="my-3 "> <i class="fas fa-building"></i>      Department：中山資訊管理學系</h5>
                </div>
                <div class="col-4 text-white" style="font-family: 'Noto Serif TC', serif;">
                    <a class="mx-2 " href=""><i class="fab fa-instagram fa-5x" style="color: #e54372"></i></a>
                    <a class="mx-2" href=""><i class="fab fa-facebook fa-5x" style="color: #4267b5"></i></a>
                    <a class="mx-2" href=""><i class="fab fa-twitter fa-5x" style="color: #41abe1"></i></a>
                </div>
              </div>
              
            
           </div>
                
        </footer>
        <footer>
          <div class="row align-items-center justify-content-center" style="background-color: #1a1d1f">
                <p class="text-center text-white " >©2020 By William、Homer、James、Park Seo Jun</p>
              </div>
        </footer>
        
        <script src="js/theme.js"></script> 
</body>
</html>