<?php

if(isset($_POST['email'])) {
    include('connMysql.php');
    $mail = $_POST['email'];
    $sql_query = "SELECT *
    FROM member
    WHERE EXISTS
    (SELECT * FROM member
    WHERE mail = '$mail');";
    $result = mysqli_query($db_link, $sql_query);
    $r = mysqli_fetch_assoc($result);

    if(!empty($r)){
        echo '<font color="red">The email <strong>'.$mail.'</strong>'. ' is already in use.</font>';
    }
    else{
        echo 'OK';
    }
}
?>