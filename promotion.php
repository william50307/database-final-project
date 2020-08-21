<?php
    include("connMysql.php");
    if(isset($_POST['store']) && !isset($_POST['store_img'])){
        $sql = "SELECT * FROM store ,onsale WHERE store.sid = onsale.sid AND store.sid = ".$_POST['store'];
        $result = mysqli_query($db_link, $sql);
        while($row=mysqli_fetch_assoc($result)){
            echo"<div class='col-md-6 col-sm-12 my-3'>
                <a href='".$row['url']."'>
                    <img style='width: 100%' src='".$row['img']."'>
                </a>
                </div>";
        }
    }
    if(isset($_POST['store_img'])){
        $sql = "SELECT * FROM store WHERE store.sid = ".$_POST['store'];
        $result = mysqli_query($db_link, $sql);
        $row=mysqli_fetch_assoc($result);
        echo "<img src='data:png;base64 ," .base64_encode($row['img'])."' style='width:100px;height:100px;margin-right:1%'>
        <a style='text-decoration:underline;;font-size:50px;font-weight:bold;'>".$row['sname']."</a>";
    }
    
?>