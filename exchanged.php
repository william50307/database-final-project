<?php
    session_start();
    include("connMysql.php");
    $mid = $_SESSION["mid"];
    $sql = "SELECT * FROM prize, exchange, member WHERE exchange.pid = prize.pid AND 
            exchange.mid = member.mid AND member.mid = $mid";
    $result = mysqli_query($db_link, $sql);
    $exist =  mysqli_num_rows($result);
    if($exist){
        echo("<div class='row align-items-center justify-content-center'>");
        while($row=mysqli_fetch_assoc($result)){
            echo("<div class='col-md-5 col-10 border border-dark mt-4' >
                  <div class='row align-items-center ' style='height:200px;'>
                    <div class='col-4' >
                        <img class='d-inline w-100 border rounded border-secondary m-3'  src='".$row['img']."' >
                    </div>
                    <div class='col-8 text-center'>
                        <p class='h1 mb-4'>".$row['prize_name']."</p>
                        <span>兌換總數：</span>
                        <span>".$row['count']."</span>
                    </div>
                   </div>
                   </div>");
        }
        echo("</div>");
    }
    else{
        echo "您尚未兌換過任何商品";
    }
?>