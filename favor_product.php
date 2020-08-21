<?php
session_start(); 
include("connMysql.php");
$mid = $_SESSION['mid'];
	
$q ="SELECT product.pname,product.pno,product.price,product.img AS pimg,store.img AS simg,supplyed.sid,store.sname
	FROM favor, product, store, supplyed
	WHERE supplyed.sid = store.sid AND supplyed.pno = product.pno 
	AND favor.mid = $mid AND favor.pno = product.pno" ;
	$result = mysqli_query($db_link, $q);

    echo    "<div class='ml-5 mt-3'>
                    <i class='fas fa-portrait fa-5x'></i>
                    <span class='ml-2' style='font-size: 40px ; font-weight:bold;'>我的收藏</span>
            </div>
            <div class='container '>";
    echo    "<div class='row align-items-center justify-content-center'>";
    echo    "<div class='col-11'>";
    echo    "<div class='row align-items-center justify-content-md-start justify-content-center '>";
	while($row=mysqli_fetch_assoc($result)){
    //取得商品供應商
        echo "
                <div class='col-md-6 col-12 border border-dark my-3' >
                <div class='row align-items-center' > 
                    <div class='col-4 my-4' >
                        <img class='d-inline w-100 border rounded border-secondary ' src='".$row['pimg']."'>
                    </div>
                    <div class='col-4 info'>
                        <p class='product_name'>".$row['pname']."</p>
                        <p class='product_price'>$".$row['price']."</p>
                            <div style='text-align: center;'>
                                <img style='display: inline' src='data:png;base64 ," .base64_encode($row['simg'])."' width='20%'>
                                <span class='product_store'>".$row['sname']."</span>
                            </div>
                    </div>
                    <div class='col-4'>
						<div class='border rounded'>
							<button type='button' onclick='confirm(".$row['pno'].")' class='btn btn-light' id='delete'>
							<img src='icon/delete.svg' width='20%'>
							<span class='px-2'>刪除此產品</span>
							</button>
                        </div>

                    </div></div></div>";
                    

        }
        echo "</div></div></div></div>"
?>