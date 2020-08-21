<?php
    if(@$_GET['search']==""){
        echo("<h4 align='center'>查無結果</h4>");
        exit(0);
    }
        //echo $_GET['store_order']."<br>";
        //echo $_GET['data_num']."<br>";
        //echo $_GET['price_order']."<br>";
        //暫定購物車js寫法
        echo "<script>$(document).ready(function(){
                $('.favor').click(function (){
                                $('.alert').html('已加入收藏').addClass('alert-success').show().delay(1000).fadeOut();
                                });
                        });</script>";
            
	if (isset($_GET['search'])) {	
        include('connMysql.php');
        $s = $_GET['search'];
	$num_pages = @$_GET['page'];	
	if (@$_GET['page'] == 0) {
		$num_pages = 1;
        }
		$pageRow_records = $_GET['data_num'];
        if ($_GET['data_num']==0){
                $pageRow_records = 6; //預設每頁筆數
        }

        $sql_query = "SELECT store.img AS simg, sname, product.img AS pimg, price, pname, 
                product.pno, store.sid FROM `product`,`supplyed`,`store` WHERE pname LIKE '%$s%' 
                AND supplyed.sid = store.sid AND supplyed.pno = product.pno";

        $startRow_records = ($num_pages -1) * $pageRow_records;
	if($_GET['store_order']!=0){
        $ord = $_GET['store_order'];
        $sql_query .= " AND supplyed.sid = $ord";
            if(isset($_GET['price_order'])){
                if($_GET['price_order'] == 2){
                    $sql_query .= " ORDER BY price ASC";
                }
                else if($_GET['price_order'] == 3){
                    $sql_query .= " ORDER BY price DESC";
                }
            }         
	}
	else{
            if(isset($_GET['price_order'])){
                if($_GET['price_order'] == 2){
                    $sql_query .= " ORDER BY price ASC";
                }
                else if($_GET['price_order'] == 3){
                    $sql_query .= " ORDER BY price DESC";
                }
            }
	}
	//$sql_query_limit = $sql_query." LIMIT ".$startRow_records.", ".$pageRow_records;
        //$result = mysqli_query($db_link, $sql_query_limit);
	$all_result = mysqli_query($db_link, $sql_query);
	$total_records = mysqli_num_rows($all_result);
        $total_pages = ceil($total_records/$pageRow_records);
        include("similarity.php");
        }
        
        //商品列
        echo "共有".$total_records."件商品";
        echo "<div class='container mt-5 ' >";
        echo "<div class='row align-items-center justify-content-center'>";
        echo "<div class='col-11'>";
        echo    "<div class='row align-items-center justify-content-md-start justify-content-center '>";
        
	if(isset($_GET['search']) && $total_records>0 ){
            for($i = 0 ; $i<$pageRow_records ; $i++){
                if($i+$startRow_records >= $total_records){
                        break;
                }
            $pno = $products[$i+$startRow_records]['pno'];
            $sql = "SELECT store.img AS simg, sname, product.img AS pimg, price, pname, 
            product.pno, store.sid FROM `product`,`supplyed`,`store` WHERE  
            supplyed.sid = store.sid AND supplyed.pno = product.pno AND product.pno = $pno";
            $result = mysqli_query($db_link, $sql);
            $row=mysqli_fetch_assoc($result);
            if($i<=$pageRow_records){
                echo "<div class='col-md-6 col-12 border border-dark my-3' >";
                echo "<div class='row align-items-center' > "; 
                echo "<div class='col-4 my-4' > ";
                echo "<img class='d-inline w-100 border rounded border-secondary '  src='".$row['pimg']."' >";
                echo "</div>";
                echo "<div class='col-4 info'>
                        <p class='product_name' >".$row['pname']."</p>
                        <p class='product_price'>$".$row['price']."</p>
                        <div style='text-align: center;'>
                            <img style='display: inline' src='data:png;base64 ," .base64_encode($row['simg'])."' width='20%' >
                            <span class='product_store'>".$row['sname']."</span>
                        </div>
                    </div>";
                echo "<div class='col-4 ' >
                        <div class='border rounded'>
                                <button onclick=\"location.href = 'form.php?pno=".$row['pno']."&sid=".$row['sid']."'\">
                                <img src='icon/loudspeak.svg' width='30%'>
                                <span>回報價格</span>
                                </button>
                        </div>
                        <div class='border  rounded'>
                                <button class='favor' onclick='addtocart(".$row['pno'].")'>
                                        <img src='icon/heart.svg' width='30%'>
                                        <span>收藏此商品</span>
                                </button>
                        </div>
                    </div>
                </div> </div>";
            }
            
            
                // $i++;
                // if($i+$startRow_records >= $total_records){
                //         break;
                // }
                // $pno = $products[$i+$startRow_records]['pno'];
                // $sql = "SELECT store.img AS simg, sname, product.img AS pimg, price, pname, 
                // product.pno, store.sid FROM `product`,`supplyed`,`store` WHERE 
                // supplyed.sid = store.sid AND product.pno = supplyed.pno AND product.pno = $pno";
                // $result = mysqli_query($db_link, $sql);
                // $row=mysqli_fetch_assoc($result);
                // if($i<=$pageRow_records){

                // echo "<div class='col-md-6 col-12 border border-dark my-3' >";
                // echo "<div class='row align-items-center' > "; 
                // echo "<div class='col-4 my-4' > 
                //  <img class='d-inline w-100 border rounded border-secondary '  src='".$row['pimg']."' >
                // </div>";
                // echo "<div class='col-4 info'>
                //                 <p class='product_name' >".$row['pname']."</p>
                //                 <p class='product_price'>$".$row['price']."</p>
                //                 <div style='text-align: center;'>
                //                 <img style='display: inline' src='data:png;base64 ," .base64_encode($row['simg'])."' width='20%' >
                //                 <span class='product_store'>".$row['sname']."</span>
                //                 </div>

                // </div>";
                // echo "<div class='col-4 ' >
                //         <div class='border  rounded'>
                //                 <button onclick=\"location.href = 'form.php?pno=".$row['pno']."&sid=".$row['sid']."'\">
                //                         <img src='icon/loudspeak.svg' width='30%'>
                //                         <span>回報價格</span>
                //                 </button>
                //                 </a>
                //         </div>
                //         <div class='border  rounded'>
                //                 <button class='favor' onclick='addtocart(".$row['pno'].")'>
                //                         <img src='icon/heart.svg' width='30%'>
                //                         <span>收藏此商品</span>
                //                 </button>
                //         </div>
                //     </div>
                // </div>
                // </div></div></div></div></div></div>";
                // }  
        }
        echo "</div></div></div></div>";
	}
	else{
	    echo("<h4 align='center'>查無結果</h4>");
	}

	if(isset($_GET['search'])){ 
            $store_order = $_GET['store_order'];
            if($_GET['store_order']==0){
                    $store_order = 0;
            }
            $data_num = $_GET['data_num'];
            if($_GET['data_num']==0){
                    $data_num = 0;
            }
            $price_order = $_GET['price_order'];
            if($_GET['price_order']==0){
                    $price_order = 0;
            }
	    	$pre = $num_pages-1;
            $next = $num_pages+1;
            echo "<ul class='pagination justify-content-center'>
            <li class='page-item'><a class='page-link text-secondary' href='search.html?search=$s&page=1&store_order=$store_order&data_num=$data_num&price_order=$price_order'>第一頁</a></li>
            <li class='page-item'><a class='page-link text-secondary' href='search.html?search=$s&page=$pre&store_order=$store_order&data_num=$data_num&price_order=$price_order'>上一頁</a></li>";

            for($i=0;$i<5;$i++){
				if($num_pages == $total_pages){
					echo "<li class='page-item'>$num_pages</li>"; 
					break;
				}
				//當前頁數在中間
				if($num_pages-2>=1){
					if($num_pages+$i-2 == $num_pages){
						echo "<li class='page-item'>$num_pages</li>";
					}
					else if($num_pages+$i-2 <= $total_pages){
						echo "<li class='page-item'><a class='page-link text-secondary' 
						href='search.html?search=$s&page=".($num_pages+$i-2)."&store_order=$store_order&
						data_num=$data_num&price_order=$price_order'>".($num_pages+$i-2)."</a></li>";
					}
				}
                else{
					if($i+1 == $num_pages){
						echo "<li class='page-item'>".($i+1)."</li>"; 
					}
					else{
						echo "<li class='page-item'><a class='page-link text-secondary' 
						href='search.html?search=$s&page=".($i+1)."&store_order=$store_order&
						data_num=$data_num&price_order=$price_order'>".($i+1)."</a></li>";
					}
                    
                }
            }
        //     for($i=0;$i<5;$i++){
  	//   	if($i+$num_pages==$num_pages){
  	//   	    echo "<li class='page-item'>".$num_pages."</li>";
  	//   	}else if($i+$num_pages <= $total_pages){
        //             $page = $i+$num_pages;
        //             echo "<li class='page-item'>
  	//             <a class='page-link text-secondary' href='search.html?search=$s&page=$page&store_order=$store_order&data_num=$data_num&price_order=$price_order'>$page</a></li>";
	// 	}
        //     }
        if($next<=$total_pages){
            echo "<li class='page-item'><a class='page-link text-secondary' href='search.html?search=$s&page=$next&store_order=$store_order&data_num=$data_num&price_order=$price_order'>下一頁</a></li>";
        }
   	    echo "<li class='page-item'><a class='page-link text-secondary' href='search.html?search=$s&page=$total_pages&store_order=$store_order&data_num=$data_num&price_order=$price_order'>最後頁</a></li></ul>";
        }
  	?>
</body>
</html>