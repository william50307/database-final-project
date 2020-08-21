<?php

//include('connMysql.php');
//$s = "咖啡";
//$sql_query = "SELECT store.img AS simg, sname, product.img AS pimg, price, pname, 
//product.pno, store.sid FROM `product`,`supplyed`,`store` WHERE  supplyed.sid = store.sid 
//AND supplyed.pno = product.pno AND pname LIKE '%$s%'";

$products = [];
$result = mysqli_query($db_link, $sql_query);
if(!$total_pages){
    
}
while($row=mysqli_fetch_assoc($result)){
    similar_text($s, $row['pname'], $percent);
    array_push($products, array('sim' => $percent,'pno' => $row['pno']));
}
//如果沒有設定order條件
if($_GET['price_order']!=2 && $_GET['price_order']!=3){
    rsort($products);
}

//print_r($arr);
// foreach($products as $key => $value){
//     echo($value['sim']."<br>");
// }
// echo "<br><br>";
// print_r ($products[735]['pno']);
// print_r ($products[736]['pno']);
// print_r ($products[737]['pno']);
// print_r ($products[738]['pno']);

?>