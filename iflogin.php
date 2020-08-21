<?php
    session_start();
    include("connMysql.php");
    if(isset($_SESSION['mid'])){
        $sql = "SELECT * FROM member WHERE mid = ".$_SESSION['mid'];
        $result = mysqli_query($db_link, $sql);
        $row = mysqli_fetch_assoc($result);
        echo "<li class='nav-item'><a class='nav-link' href='member.html'>會員中心</a></li>
                <span class='text-white'>".$row['name'].",您好<span>";
    }
    else{
        echo "<li class='nav-item'><a class='nav-link' href='login.html'>登入</a></li>
        <li class='nav-item'><a class='nav-link' href='register.html'>註冊</a></li>";
    }
?>