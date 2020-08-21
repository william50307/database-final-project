<?php
    session_start();
    include('connMysql.php');
    $s = '茶飲';
    $sql_query = "SELECT pname, img 
                  FROM `product` 
                  WHERE m_cate LIKE '%$s%'
                  LIMIT 10 ";
    $result = mysqli_query($db_link, $sql_query);
    $price = 50;
    while($row=mysqli_fetch_assoc($result)){
        $insert = "INSERT INTO prize (start_date,end_date,prize_name,point,amount,img) 
        VALUES('2020-06-1','2020-06-7','".$row['pname']."',$price,10,'".$row['img']."')";
        mysqli_query($db_link, $insert);
        $price += 50;
    };
?>