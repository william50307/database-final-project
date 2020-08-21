<?php
session_start();
include("connMysql.php");
//putenv('PYTHONPATH=x');
$mid = $_SESSION['mid'];
exec('C:\xampp\htdocs\db\DBMS1\recommend.py $mid',$array);
$keyword = $array[0];
print_r($array);
echo($keyword);
$sql = "SELECT store.img AS simg, sname, product.img AS pimg, price, pname, 
        product.pno, store.sid FROM `product`,`supplyed`,`store` WHERE pname LIKE '%$keyword%' 
        AND supplyed.sid = store.sid AND supplyed.pno = product.pno LIMIT 8";
$results = mysqli_query($db_link, $sql);
while($row=mysqli_fetch_assoc($results)){
    echo "<div class='col-3 text-center '>  
			<div class='border border-dark'>
				<div class='mx-auto' style='width: 75%;'>
					<img class='w-100 border mt-2' src='".$row['pimg']."' >
				</div>
				<p class='h3 text-danger my-1'><b>NT$ ".$row['price']."</b></p>
				<p class='h4'><b>".$row['pname']."</b></p>
				<div class='w-100'>
					<img class='w-5 d-inline' src='icon/store_icon/pxmart.png' > 
					<p class='d-inline'>".$row['sname']."</p>
				</div>
			</div>
		</div>";
}
//$encode = mb_detect_encoding($array[0], array("ASCII","UTF8","GB2312","GBK","BIG5")); 
//echo "encode:".$encode;
//
//$output = mb_convert_encoding($array[0],'UTF-8','EUC-CN');
//echo $output;
//$result = shell_exec('C:\xampp\htdocs\db\DBMS1\test.py '. '123');#pid
//echo ($result);//取得關鍵字
?>