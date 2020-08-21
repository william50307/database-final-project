<?php
    include('connMysql.php');
    session_start();
    //建立關鍵字資料
    if(isset($_POST['keyword'])){
        $key = $_POST['keyword'];
        $sql = "SELECT keyword FROM keyword WHERE keyword='$key'";
        $r = mysqli_query($db_link, $sql);
        $exist = mysqli_num_rows($r);
        //判斷該關鍵字是否存在
        if(!$exist){
            //寫入keyword，計算該筆資料在每個分類中的占比
            $sql="SELECT m_cate , count(product.pno) AS count 
                  FROM product, supplyed, store
                  WHERE pname LIKE '%$key%' AND product.pno = supplyed.pno AND
                  store.sid = supplyed.sid AND store.sid = 1
                  GROUP BY m_cate";
            $r = mysqli_query($db_link, $sql);
            $insert = "INSERT INTO keyword (keyword,total";
            $total = 0;
            while($row = mysqli_fetch_assoc($r)){
                $insert .= ",".$row['m_cate'];
                $total += $row['count'];
            }
            //若搜尋結果不為0
            if($total){
                echo('total not zero');
                $insert .= ") VALUES ('$key',$total";
                $r = mysqli_query($db_link, $sql);
                while($row = mysqli_fetch_assoc($r)){
                    $insert .= ",".$row['count']/$total;
                }
                $insert .= ")";
                mysqli_query($db_link, $insert);
            
                //取得keyword最後一筆資料的id
                $sql = "SELECT * FROM `keyword` ORDER BY keyword_id DESC LIMIT 0 , 1";
                $r = mysqli_query($db_link, $sql);
                $row = mysqli_fetch_assoc($r);
                $keyword_id = $row['keyword_id'];
                echo ("<script>alert('$keyword_id');</script>");
                //寫入search
                $insert = "INSERT INTO search (mid, keyword_id) VALUES (".$_SESSION['mid'].",$keyword_id)";
                mysqli_query($db_link, $insert);
                echo('keyword saved');
            }
        }
    }
    else{
        echo "no search data";
    }
    // foreach ($keyword as $value) {
    // $sql="SELECT m_cate , count(product.pno) AS count 
    //               FROM product, supplyed, store
    //               WHERE pname LIKE '%$value%' AND product.pno = supplyed.pno AND
    //               store.sid = supplyed.sid AND store.sid = 1
    //               GROUP BY m_cate";
    //         $r = mysqli_query($db_link, $sql);
    //         $insert = "INSERT INTO keyword (keyword,total";
    //         $total = 0;
    //         while($row = mysqli_fetch_assoc($r)){
    //             $insert .= ",".$row['m_cate'];
    //             $total += $row['count'];
    //         }
    //         $insert .= ") VALUES ('$value',$total";
    //         $r = mysqli_query($db_link, $sql);
    //         while($row = mysqli_fetch_assoc($r)){
    //             $insert .= ",".$row['count']/$total;
    //         }
    //         $insert .= ")";
    //         mysqli_query($db_link, $insert);
    //     }


    //創建資料表
    // $sql = "SELECT DISTINCT m_cate FROM store, supplyed, product 
    //     WHERE store.sid = supplyed.sid AND product.pno = supplyed.pno AND store.sid = 1";
    // $result = mysqli_query($db_link, $sql);
    // $mcate = [];
    // while($row=mysqli_fetch_assoc($result)){
    //     array_push($mcate,$row['m_cate']);
    // }
    // print_r ($mcate);
    // $attrs = "";
    // foreach ($mcate as $value) {
    //     $attrs .= ",".$value." int";
    // }
    // $sql = "CREATE TABLE keyword
    //         (keyword_id int,
    //         keyword char(50)$attrs);";
    // print_r ($sql);
    // mysqli_query($db_link, $sql);

?>