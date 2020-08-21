<!DOCTYPE html>
<?php session_start(); ?>
<html>
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
	<!-- slick -->
	<link rel="stylesheet" type="text/css" href="slick/slick.css"/>
	<link rel="stylesheet" type="text/css" href="slick/slick-theme.css"/>
	<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
	<script type="text/javascript" src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
	<script type="text/javascript" src="slick/slick.min.js"></script>
</head>
<script>
	//是否登入
	$(document).ready(function() { 
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
	<!-- 導覽列 -->
	<header class="main_menu_area " style="background-color: #000000a1;height: 15%">
            <nav class="navbar navbar-expand-lg navbar-secondary bg-secondary">
                <a class="navbar-brand" href="index.php"><img src="icon/Xprice.png" width="50%" alt=""></a>
                <button class="navbar-toggler " type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-sliders-h text-white fa-2x"></i>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav" id=nav>
                        <li class="nav-item"><a class="nav-link" href="onsale.html">特價專區</a></li>
						<li class="nav-item"><a class="nav-link" href="map.html">搜尋店面</a></li>
                    </ul>
                </div>
            </nav>
        </header>
	<!-- 搜尋列 -->
	<form action='search.html' method="GET">
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
	<!-- 圖片輪播 -->
	<div class="container " style="margin:2% auto;  background: #EDEDED ">
        <div id="myCarousel" class="carousel slide " data-ride="carousel">
            <!-- 連結導引項目 -->
            <ul class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active" ></li>
                <li data-target="#myCarousel" data-slide-to="1" ></li>
                <li data-target="#myCarousel" data-slide-to="2" ></li>
				<li data-target="#myCarousel" data-slide-to="3" ></li>
				<li data-target="#myCarousel" data-slide-to="4" ></li>
				<li data-target="#myCarousel" data-slide-to="5" ></li>
				<li data-target="#myCarousel" data-slide-to="6" ></li>
            </ul>
            <!-- 幻燈片圖片 -->
           <div class="carousel-inner text-center ">
            	<div style="width:auto;height:300px">
	                <div class="carousel-item active" style="height:300px">
	                    <img  src="icon/store_sale/大潤發優惠1.jpg" height="100%">
	                </div>
	                <div class="carousel-item" style="height:300px">
	                    <img src="icon/store_sale/全聯優惠1.png"  height="100%">
	                </div>
	                <div class="carousel-item" style="height:300px">
	                    <img  src="icon/store_sale/全聯優惠2.png" height="100%">
	                </div>
					<div class="carousel-item" style="height:300px">
	                    <img  src="icon/store_sale/全聯優惠3.jpg" height="100%">
	                </div>
					<div class="carousel-item " style="height:300px">
	                    <img  src="icon/store_sale/全聯優惠4.jpg" height="100%">
	                </div>
					<div class="carousel-item" style="height:300px">
	                    <img  src="icon/store_sale/全聯優惠5.jpg" height="100%">
	                </div>
					<div class="carousel-item" style="height:300px">
	                    <img  src="icon/store_sale/全聯優惠6.png" height="100%">
	                </div>
                </div>
            </div>
            <!-- 左右控制指示 -->
            <a class="carousel-control-prev text-dark" href="#myCarousel" data-slide="prev">
                <i class="fas fa-arrow-circle-left fa-3x"></i>
            </a>
            <a class="carousel-control-next text-dark" href="#myCarousel" data-slide="next">
                <i class="fas fa-arrow-circle-right fa-3x" ></i>
            </a>
        </div>
	</div>

	<!-- 推薦商品 -->
	<div class="row justify-content-center align-items-center saleitem "id="recommend">
		
	</div>

	<script type="text/javascript"> 
		$(document).ready(function(){
		  $('.saleitem').slick({
				infinite: true,  //重複 
				slidesToShow: 4, //幾個同時出現
				slidesToScroll: 4, 
				autoplay: true,
  				autoplaySpeed: 2000,
				responsive: [{
					breakpoint: 1024,
					settings: {
						slidesToShow: 3,
						slidesToScroll: 3,
						infinite: true,
						dots: true
					}
					},
					{
					breakpoint: 600,
					settings: {
						slidesToShow: 2,
						slidesToScroll: 2
					}
					}]
		  		});
		  });
	  </script>
	<!-- 推薦商品 -->
	<h3>為您推薦</h3>
	<div class="row justify-content-center align-items-center saleitem ">
	<?php
	 	if(!isset($_SESSION['mid'])){
			 echo('<span>請先登入</span>');
		}
		else{
			include("connMysql.php");
			//putenv('PYTHONPATH=x');
			$mid = $_SESSION['mid'];
			exec('C:\xampp\htdocs\db\DBMS1\recommend.py $mid',$array);
			$keyword = $array[0];
			$sql = "SELECT store.img AS simg, sname, product.img AS pimg, price, pname, url,
				product.pno, store.sid FROM `product`,`supplyed`,`store` WHERE pname LIKE '%$keyword%' 
				AND supplyed.sid = store.sid AND supplyed.pno = product.pno LIMIT 8";
			$results = mysqli_query($db_link, $sql);
			while($row=mysqli_fetch_assoc($results)){
			echo "<div class='col-3 text-center '>  
					<div class='border border-dark' style='height:365px;'>
						<div class='mx-auto' style='width: 75%;'>					
							<a href='".$row['url']."'><img class='w-100 border mt-2' src='".$row['pimg']."' ></a>
						</div>
						<p class='h3 text-danger my-1'><b>NT$ ".$row['price']."</b></p>
						<p class='h4'><b>".$row['pname']."</b></p>
						<div class='w-100'>
							<img class='w-5 d-inline' src='data:png;base64 ," .base64_encode($row['simg'])."' > 
							<p class='d-inline'>".$row['sname']."</p>
						</div>
					</div>
				</div>";
		 	}
		} ?>
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