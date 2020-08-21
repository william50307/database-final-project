<?php
    session_start();
    include("connMysql.php");
    $sql = "DELETE FROM `favor` WHERE `pno` = ".$_POST['pno']." AND `mid` = ".$_SESSION['mid'];
    mysqli_query($db_link, $sql);
    echo 'delete';
?>